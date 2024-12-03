<?php
// Include the Message class
include "../classes/message_class.php";

// Send a message from customer to admin
function sendContactMessageController($user_id, $message_content)
{
    $message = new Message();
    return $message->sendContactMessage($user_id, $message_content);
}

// Get unread messages for admin
function getMessagesController()
{
    $message = new Message();
    return $message->getAdminMessages();
}

// Reply to a customer message
function replyMessageController($message_id, $reply_content)
{
    $message = new Message();
    return $message->replyToMessage($message_id, $reply_content);
}

// Mark message as read
function markContactMessageAsReadController($message_id)
{
    $message = new Message();
    return $message->markContactMessageAsRead($message_id);
}

function getCustomerContactMessagesController($userID) 
{
    $message = new Message();
    return $message->getCustomerContactMessages($userID);
}


?>
