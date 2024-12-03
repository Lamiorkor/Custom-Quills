<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('../controllers/payment_controller.php');
require_once('../controllers/order_controller.php');

$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['reference']) && isset($data['order_id'])) {
    $reference = $data['reference'];
    $order_id = $data['order_id'];

    // Verify payment via Paystack API
    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => "https://api.paystack.co/transaction/verify/$reference",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => [
            "Authorization: Bearer sk_test_7a0f173e62ebb1e59878a47e6085848c78332d3d",
            "Cache-Control: no-cache",
        ],
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);

    if ($err) {
        echo json_encode(["status" => "error", "message" => "Payment verification failed."]);
        exit();
    }

    $responseData = json_decode($response, true);
    if ($responseData['status'] && $responseData['data']['status'] === "success") {
        $amount = $responseData['data']['amount'] / 100;
        $currency = $responseData['data']['currency'];
        $payment_date = $responseData['data']['paid_at'];

        // Record payment and update order status
        addPaymentController($amount, $_SESSION['user_id'], $order_id, $currency, $reference, $payment_date);
        updateOrderStatusController($order_id, 'paid');

        echo json_encode(["status" => "success"]);
        exit();
    }
}

echo json_encode(["status" => "error", "message" => "Invalid payment data."]);
