<?php
session_start();
require_once('../controllers/message_controller.php');

$data = json_decode(file_get_contents('php://input'), true);
$message = $data['message'];
$receiverID = $data['receiver_id'];
$senderID = $_SESSION['user_id'];

// Call the controller to save the message
if (sendMessageController($senderID, $receiverID, $message)) {
    echo json_encode(['status' => 'success', 'message' => ['content' => $message]]);
} else {
    echo json_encode(['status' => 'error']);
}
?>
