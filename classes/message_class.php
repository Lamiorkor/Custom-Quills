<?php
require_once ("../settings/db_class.php");

class Message extends db_connection
{
    // Send a contact message from customer
    public function sendContactMessage($user_id, $message_content)
    {
        $ndb = new db_connection();

        // Ensure inputs are valid and prevent SQL injection
        $user_id = mysqli_real_escape_string($ndb->db_conn(), $user_id);
        $message_content = mysqli_real_escape_string($ndb->db_conn(), $message_content);
        $time_sent = date('Y-m-d H:i:s');

        $sql = "INSERT INTO `contact` (`user_id`, `message`, `is_read`, `time_sent`) 
                VALUES ('$user_id', '$message_content', 0, '$time_sent')";

        return $this->db_query($sql);
    }

    // Get messages for admin (messages that have been sent to the admin)
    public function getAdminMessages()
    {
        $ndb = new db_connection();

        $sql = "SELECT c.*, u.name, u.email 
                FROM contact c
                JOIN users u ON c.user_id = u.user_id
                WHERE c.is_read = 0";  // only unread messages

        $result = $ndb->db_query($sql);

        if ($result) {
            return $ndb->db_fetch_all();
        }

        return [];
    }

    // Mark a message as read
    public function markContactMessageAsRead($message_id)
    {
        $ndb = new db_connection();

        // Ensure message_id is valid and prevent SQL injection
        $message_id = mysqli_real_escape_string($ndb->db_conn(), $message_id);

        $sql = "UPDATE `contact` SET `is_read` = 1 WHERE `contact_id` = '$message_id'";

        return $this->db_query($sql);
    }

    // Save admin reply to a message
    public function replyToMessage($message_id, $reply_content)
    {
        $ndb = new db_connection();

        // Ensure inputs are valid and prevent SQL injection
        $message_id = mysqli_real_escape_string($ndb->db_conn(), $message_id);
        $reply_content = mysqli_real_escape_string($ndb->db_conn(), $reply_content);
        $time_sent = date('Y-m-d H:i:s');

        $sql = "UPDATE `contact` SET `reply` = '$reply_content', `time_sent` = '$time_sent' 
                WHERE `contact_id` = '$message_id'";

        return $this->db_query($sql);
    }

    // Get contact form messages for a specific customer
    public function getCustomerContactMessages($user_id)
    {
        $ndb = new db_connection();

        // Ensure user_id is valid and prevent SQL injection
        $user_id = mysqli_real_escape_string($ndb->db_conn(), $user_id);

        $sql = "SELECT * FROM `contact` WHERE `user_id` = '$user_id' ORDER BY `time_sent` DESC";

        $result = $ndb->db_query($sql);

        if ($result) {
            return $ndb->db_fetch_all();
        }

        return [];
    }

}
?>
