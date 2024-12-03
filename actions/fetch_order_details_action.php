<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require_once('../controllers/order_controller.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the order_id from the POST request
    $data = json_decode(file_get_contents('php://input'), true);
    $order_id = $data['order_id'];

    if (!isset($_SESSION['user_id'])) {
        echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
        exit();
    }

    // Fetch order details
    $orderDetails = getOrderDetailsController($order_id);

    if ($orderDetails) {
        echo json_encode(['status' => 'success', 'data' => $orderDetails]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Order details not found.']);
    }
}
?>
