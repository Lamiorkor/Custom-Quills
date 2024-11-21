<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once ('../controllers/order_controller.php');
require_once ('../controllers/cart_controller.php');
$cartItems = getCartItemsController();

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from form submission
    $customerID = $_SESSION['user_id'];
    $invoiceNumber = rand(00001, 99999);
    $orderDate = date("Y-m-d");
    $status = "Pending";


    // Call addOrderController
    $newOrder = addOrderController($customerID, $invoiceNumber, $orderDate, $status);

    // Check if registration was successful
    if ($newOrder !== false) {
        foreach ($cartItems as $service) {
            $serviceID = $service['s_id'];
            $quantity = $service['qty'];
            // Call orderDetailsController
            $orderDetails = addOrderDetailsController($newOrder, $serviceID, $quantity);

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
