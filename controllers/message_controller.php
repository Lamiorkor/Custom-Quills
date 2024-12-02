<?php
require("../classes/message_class.php");

function addMessageController($userID, $content)
{
    $messages = new Message();
    return $messages->addMessage($userID, $content);
}

function getMessagesController()
{
    $messages = new Message();
    return $messages->getMessages();
}

function getCustomerMessagesController($userID)
{
    $messages = new Message();
    return $messages->getCustomerMessages($userID);
}

function saveReplyController($messageID, $reply)
{
    $messages = new Message();
    return $messages->saveReply($messageID, $reply);
}

function sendMessageController($senderID, $receiverID, $message) {
    $messageObj = new Message();
    return $messageObj->sendMessage($senderID, $receiverID, $message);
}

function getMessagesForConversationController($userID) {
    $messageObj = new Message();
    return $messageObj->getMessagesByUser($userID);
}

?>
