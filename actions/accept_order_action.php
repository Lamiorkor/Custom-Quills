<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require_once('../controllers/writer_controller.php');

// Ensure the writer is logged in and the user is a writer
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] === 'customer') {
    header("Location: ../view/login.php");
    exit();
}

$order_id = isset($_GET['order_id']) ? intval($_GET['order_id']) : null;

// Ensure the order ID is valid
if (!$order_id) {
    header("Location: ../writer_view/writer_order_requests.php?error=Invalid order ID.");
    exit();
}

// Call the function to accept the order and update its status
$updateResult = acceptOrderController($_SESSION['user_id'], $order_id);

// Check if the order was updated successfully
if ($updateResult) {
    // Redirect back to the order requests page with success message
    header("Location: ../writer_view/writer_order_requests.php?success=Order accepted successfully.");
    exit();
} else {
    // Redirect back with an error message if the order couldn't be updated
    header("Location: ../writer_view/writer_order_requests.php?error=Failed to accept the order.");
    exit();
}
?>
