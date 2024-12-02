<?php
session_start();
require('../controllers/message_controller.php');

if (isset($_POST['message_id'], $_POST['reply']) && !empty($_POST['reply'])) {
    $messageID = $_POST['message_id'];
    $reply = $_POST['reply'];

    $result = saveReplyController($messageID, $reply);

    if ($result) {
        header("Location: ../admin_view/manage_messages.php?success=reply_saved");
    } else {
        header("Location: ../admin_view/manage_messages.php?error=failed_to_save_reply");
    }
} else {
    header("Location: ../admin_view/manage_messages.php?error=invalid_reply");
}
?>
