<?php
session_start();
require('../controllers/message_controller.php');

// Validate form submission
if (isset($_POST['name'], $_POST['email'], $_POST['message']) && !empty($_POST['message'])) {
    $userID = $_SESSION['user_id']; // Assuming logged-in user's ID is stored in session
    $content = $_POST['message'];

    $result = addMessageController($userID, $content);

    if ($result) {
        header("Location: ../customer_view/customer_contact.php?success=message_sent");
    } else {
        header("Location: ../customer_view/customer_contact.php?error=failed_to_send");
    }
} else {
    header("Location: ../customer_view/customer_contact.php?error=invalid_input");
}
?>
