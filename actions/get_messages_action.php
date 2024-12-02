<?php
session_start();
require_once('../controllers/message_controller.php');

$userID = $_SESSION['user_id'];
$messages = getMessagesForConversationController($userID);

echo json_encode(['status' => 'success', 'messages' => $messages]);
?>
