<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require_once('../controllers/message_controller.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: ../view/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$message_content = isset($_POST['message']) ? trim($_POST['message']) : null;

if ($message_content) {
    $result = sendContactMessageController($user_id, $message_content);

    if ($result) {
        $_SESSION['success_message'] = "Your message has been sent successfully.";
        header("Location: ../customer_view/customer_contact.php");
        exit();
    } else {
        $_SESSION['error_message'] = "Failed to send the message. Please try again.";
        header("Location: ../customer_view/customer_contact.php");
        exit();
    }
} else {
    $_SESSION['error_message'] = "Message content cannot be empty.";
    header("Location: ../customer_view/customer_contact.php");
    exit();
}
?>
