<?php

session_start();
require_once('../controllers/order_controller.php');
require_once('../controllers/email_controller.php'); // Include the email sending functions

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'writer') {
    header("Location: ../view/login.php");
    exit();
}

if (isset($_GET['order_id']) && isset($_GET['customer_email'])) {
    $order_id = $_GET['order_id'];
    $customer_email = $_GET['customer_email'];

    // Mark order as completed
    $update_status = updateOrderStatusController($order_id, 'completed');
    
    if ($update_status) {
        // Prepare email content
        $subject = "Your Poem is Ready!";
        $message = "Dear Customer,\n\nYour requested poem has been completed. Please log in to view or download it.\n\nBest regards,\nCustom Quills";

        // Send email to customer
        if (sendPoemCompletionEmail($customer_email, $subject, $message)) {
            // Redirect back with success message
            header("Location: ../writer_view/writer_order_requests.php?success=Order marked as completed and customer notified!");
        } else {
            header("Location: ../writer_view/writer_order_requests.php?error=Failed to send email.");
        }
    } else {
        header("Location: ../writer_view/writer_order_requests.php?error=Failed to mark order as completed.");
    }
} else {
    header("Location: ../writer_view/writer_order_requests.php?error=Invalid order.");
}

?>
