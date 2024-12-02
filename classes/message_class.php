<?php
require("../settings/db_class.php");

class Message extends db_connection
{
    public function addMessage($userID, $content)
    {
        $userID = mysqli_real_escape_string($this->db_conn(), $userID);
        $content = mysqli_real_escape_string($this->db_conn(), $content);

        $sql = "INSERT INTO `messages` (`user_id`, `content`, `is_read`, `date_created`) 
                VALUES ('$userID', '$content', false, NOW())";

        return $this->db_query($sql);
    }

    public function getMessages()
    {
        $sql = "SELECT m.message_id, m.user_id, m.content, m.is_read, m.date_created, m.reply, u.name, u.email
                FROM `messages` m
                JOIN `users` u ON m.user_id = u.user_id
                ORDER BY m.date_created DESC";

        if ($this->db_query($sql)) {
            return $this->db_fetch_all();
        }
        return [];
    }

    public function getCustomerMessages($userID)
    {
        $userID = mysqli_real_escape_string($this->db_conn(), $userID);

        $sql = "SELECT message_id, content, reply, date_created, is_read 
                FROM `messages` 
                WHERE `user_id` = '$userID'
                ORDER BY `date_created` DESC";

        if ($this->db_query($sql)) {
            return $this->db_fetch_all();
        }
        return [];
    }

    public function saveReply($messageID, $reply)
    {
        $messageID = mysqli_real_escape_string($this->db_conn(), $messageID);
        $reply = mysqli_real_escape_string($this->db_conn(), $reply);

        $sql = "UPDATE `messages` SET `reply` = '$reply', `is_read` = false WHERE `message_id` = '$messageID'";

        return $this->db_query($sql);
    }

    public function sendMessage($senderID, $receiverID, $content) {
        $ndb = new db_connection();
        $senderID = mysqli_real_escape_string($ndb->db_conn(), $senderID);
        $receiverID = mysqli_real_escape_string($ndb->db_conn(), $receiverID);
        $content = mysqli_real_escape_string($ndb->db_conn(), $content);

        $sql = "INSERT INTO `messages` (`sender_id`, `receiver_id`, `content`, `is_read`, `date_created`) 
                VALUES ('$senderID', '$receiverID', '$content', false, NOW())";

        return $ndb->db_query($sql);
    }

    public function getMessagesByUser($userID) {
        $ndb = new db_connection();
        $userID = mysqli_real_escape_string($ndb->db_conn(), $userID);

        $sql = "SELECT * FROM `messages` WHERE `receiver_id` = '$userID' ORDER BY `date_created` DESC";
        return $ndb->db_fetch_all($sql);
    }
}
?>
