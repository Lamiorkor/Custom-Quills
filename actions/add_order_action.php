<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require_once ('../controllers/order_controller.php');
require_once ('../controllers/cart_controller.php');

$customer_id = $_SESSION['user_id'];
$cartItems = getCartItemsController($customer_id);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from form submission
    $invoiceNumber = rand(00001, 99999);
    $orderDate = date("Y-m-d");
    $receiveDate = $_POST['receive_date'];
    $totalAmt = $_POST['total_amount'];

    // Call addOrderController
    $newOrder = addOrderController($customerID, $invoiceNumber, $orderDate, $receiveDate, $totalAmt);

    // Check if registration was successful
    if ($newOrder !== false) {
        foreach ($cartItems as $service) {
            $serviceID = $service['service_id'];
            $writerID = 1;
            $quantity = $service['qty'];
            // Call orderDetailsController
            $orderDetails = addOrderDetailsController($orderID, $serviceID, $writerID, $quantity);

            if (!$orderDetails) {
                echo "Addition of order details failed. Please try again.";
                header("Location:../view/cart.php");
                exit();
            }

            // Redirect to order_confirmation page with success message
            header("Location:../view/order_confirmation.php");
            exit();
        }

    } else {
        // Redirect to order_confirmation page with error message
        echo "Addition of order failed. Please try again.";
        header("Location:../view/cart.php");
        exit();
    }
}

?>
