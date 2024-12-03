<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require_once('../controllers/order_controller.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: ../view/login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];
    $user_id = $_SESSION['user_id'];

    // Update order status to "cancelled"
    $orderUpdated = updateOrderStatusController($order_id, 'cancelled');

    // Delete related order details
    $detailsDeleted = deleteOrderDetailsController($order_id);

    // Redirect based on the operation's success or failure
    if ($orderUpdated && $detailsDeleted) {
        header("Location: ../customer_view/customer_orders.php?success=Order successfully cancelled.");
        exit();
    } else {
        header("Location: ../customer_view/customer_orders.php?error=Failed to cancel the order.");
        exit();
    }
} else {
    header("Location: ../customer_view/customer_orders.php?error=Invalid request.");
    exit();
}
?>
