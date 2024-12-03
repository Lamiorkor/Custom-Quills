<?php
session_start();
require_once('../controllers/message_controller.php');

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'administrator') {
    header("Location: ../view/login.php");
    exit();
}

$message_id = isset($_POST['message_id']) ? intval($_POST['message_id']) : null;
$reply_content = isset($_POST['reply']) ? trim($_POST['reply']) : null;

if ($message_id && $reply_content) {
    $result = replyMessageController($message_id, $reply_content);

    if ($result) {
        markContactMessageAsReadController($message_id); // Mark the message as read after replying
        $_SESSION['success_message'] = "Reply has been sent successfully.";
        header("Location: ../admin_view/manage_messages.php");
        exit();
    } else {
        $_SESSION['error_message'] = "Failed to send the reply. Please try again.";
        header("Location: ../admin_view/manage_messages.php");
        exit();
    }
} else {
    $_SESSION['error_message'] = "Message ID and reply content cannot be empty.";
    header("Location: ../admin_view/manage_messages.php");
    exit();
}
?>
