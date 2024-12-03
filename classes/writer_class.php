<?php
// Connect to database class
require("../settings/db_class.php");

/**
 * Writer class to handle writer-related database functions.
 */
class Writer extends db_connection
{
    // Add a new brand to the database
    public function addWriter($userID, $yearsOfExperience, $speciality, $rating, $availability)
    {
        $ndb = new db_connection();

        $userID = mysqli_real_escape_string($ndb->db_conn(), $userID);
        $yearsOfExperience = mysqli_real_escape_string($ndb->db_conn(), $yearsOfExperience);
        $speciality = mysqli_real_escape_string($ndb->db_conn(), $speciality);
        $rating = mysqli_real_escape_string($ndb->db_conn(), $rating);
        $availability = mysqli_real_escape_string($ndb->db_conn(), $availability);

        $sql = "INSERT INTO `writers` (`user_id`, `years_of_experience`, `speciality`, `rating`, `availability_status`) 
                VALUES ('$userID', '$yearsOfExperience', '$speciality', '$rating', '$availability')";

        return $ndb->db_query($sql);
    }


    public function deleteWriter($writerID)
    {
        $ndb = new db_connection();

        // Prepare SQL statement
        $sql = "DELETE FROM `writers` WHERE `writer_id` = '$writerID'";

        // Execute query and return result
        return $this->db_query($sql);
    }

    public function getWriters()
    {
        $ndb = new db_connection();

        // Prepare SQL statement
        $sql = "SELECT `writers`.*, `users`.`name` 
                FROM `writers`
                JOIN `users` ON `users`.`user_id` = `writers`.`user_id`";

        $result = mysqli_real_escape_string($ndb->db_conn(), $sql);

        // Execute query and return result
        $result = $ndb->db_query($sql);

        if ($result) {
            return $ndb->db_fetch_all();
        }

        return [];
    }

    public function adminUpdateWriter($writerID, $yearsOfExperience, $writerSpeciality, $writerRating, $writerAvailability)
    {
        $ndb = new db_connection();

        $writer_id = mysqli_real_escape_string($ndb->db_conn(), $writerID);
        $experience = mysqli_real_escape_string($ndb->db_conn(), $yearsOfExperience);
        $speciality = mysqli_real_escape_string($ndb->db_conn(), $writerSpeciality);
        $rating = mysqli_real_escape_string($ndb->db_conn(), $writerRating);
        $availability = mysqli_real_escape_string($ndb->db_conn(), $writerAvailability);

        // Prepare SQL statement
        $sql = "UPDATE `writers` SET `years_of_experience` = '$experience', 
                `speciality` = '$speciality', `rating` = '$rating', `availability_status` = '$availability' 
                WHERE `writer_id` = '$writer_id'";

        // Execute query and return result
        $result = $ndb->db_query($sql);

        if ($result !== false) {
            return true;
        } else {
            return false;
        }
    }

    public function getOneWriter($writerID)
    {
        // Sanitize writerID input to prevent SQL injection
        $ndb = new db_connection();
        $writerID = mysqli_real_escape_string($ndb->db_conn(), $writerID);

        // SQL query to select a single writer by ID
        $sql = "SELECT `writers`.*, `users`.`name` FROM `writers` 
                JOIN `users` ON `writers`.`user_id` = `users`.`user_id`
                WHERE `writer_id` = '$writerID' LIMIT 1";

        // Execute the query
        if (!$ndb->db_query($sql)) {
            return false; // If query fails, return false
        }

        // Check if any rows were returned
        if ($ndb->db_count() > 0) {
            // Fetch and return the writer's data as an associative array
            return $ndb->db_fetch_one($sql);
        } else {
            return null; // No writer found with the given ID
        }
    }

    public function updateWriter($userID, $userName, $userEmail, $password, $yearsOfExperience, $speciality, $availability)
    {
        $ndb = new db_connection();

        $user_id = mysqli_real_escape_string($ndb->db_conn(), $userID);
        $user_name = mysqli_real_escape_string($ndb->db_conn(), $userName);
        $user_email = mysqli_real_escape_string($ndb->db_conn(), $userEmail);
        $password = mysqli_real_escape_string($ndb->db_conn(), $password);
        $years_of_experience = mysqli_real_escape_string($ndb->db_conn(), $yearsOfExperience);
        $speciality = mysqli_real_escape_string($ndb->db_conn(), $speciality);
        $availability = mysqli_real_escape_string($ndb->db_conn(), $availability);

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "UPDATE `writers` 
            SET `writer_name` = '$user_name', `email` = '$user_email', `password` = '$hashed_password', 
                `years_of_experience` = '$years_of_experience', `speciality` = '$speciality', `availability_status` = '$availability'
            WHERE `writer_id` = '$user_id'";

        return $ndb->db_query($sql);
    }


    public function addWriterRequest($orderID, $writerID, $orderStatus, $dateCreated)
    {
        $ndb = new db_connection();

        $order_id = mysqli_real_escape_string($ndb->db_conn(), $orderID);
        $writer_id = mysqli_real_escape_string($ndb->db_conn(), $writerID);
        $order_status = mysqli_real_escape_string($ndb->db_conn(), $orderStatus);
        $date_created = mysqli_real_escape_string($ndb->db_conn(), $dateCreated);

        $sql = "INSERT INTO `writer_requests` (`order_id`, `writer_id`, `status`, `date_created`) 
                VALUES ('$order_id', '$writer_id', '$order_status', '$date_created')";

        return $ndb->db_query($sql);
    }

    public function getWriterRequests($writerID)
    {
        $ndb = new db_connection();

        $writer_id = mysqli_real_escape_string($ndb->db_conn(), $writerID);

        // SQL query to fetch all necessary details for the writer's view
        $sql = "SELECT 
                    `wr`.`order_id`, 
                    `u`.`name` AS `customer_name`, 
                    `s`.`service_name`, 
                    `o`.`instructions`, 
                    `o`.`receive_by_date`, 
                    `wr`.`status` AS `order_status`
                FROM `writer_requests` `wr`
                JOIN `orders` `o` ON `wr`.`order_id` = `o`.`order_id`
                JOIN `order_details` `od` ON `wr`.`order_id` = `od`.`order_id`
                JOIN `users` `u` ON `o`.`customer_id` = `u`.`user_id`
                JOIN `services` `s` ON `od`.`service_id` = `s`.`service_id`
                WHERE `wr`.`writer_id` = '$writer_id'
                ORDER BY `o`.`receive_by_date` DESC";

        $result = $ndb->db_query($sql);

        if ($result) {
            return $ndb->db_fetch_all();
        }
        return [];
    }

    public function getPendingWriterRequests($writerID)
    {
        $ndb = new db_connection();

        $writer_id = mysqli_real_escape_string($ndb->db_conn(), $writerID);

        $sql = "SELECT 
                    `wr`.`order_id`, 
                    `u`.`name` AS `customer_name`, 
                    `s`.`service_name`, 
                    `o`.`instructions`, 
                    `o`.`receive_by_date`, 
                    `wr`.`status` AS `order_status`
                FROM `writer_requests` `wr`
                JOIN `orders` `o` ON `wr`.`order_id` = `o`.`order_id`
                JOIN `order_details` `od` ON `wr`.`order_id` = `od`.`order_id`
                JOIN `users` `u` ON `o`.`customer_id` = `u`.`user_id`
                JOIN `services` `s` ON `od`.`service_id` = `s`.`service_id`
                WHERE `wr`.`writer_id` = '$writer_id' AND `wr`.`status` = 'pending'
                ORDER BY `o`.`receive_by_date` DESC";

        $result = $ndb->db_query($sql);

        if ($result) {
            return $ndb->db_fetch_all();
        }
        return [];
    }

    public function getInProgressWriterRequests($writerID)
    {
        $ndb = new db_connection();

        $writer_id = mysqli_real_escape_string($ndb->db_conn(), $writerID);

        $sql = "SELECT 
                    `wr`.`order_id`, 
                    `u`.`name` AS `customer_name`, 
                    `s`.`service_name`, 
                    `o`.`instructions`, 
                    `o`.`receive_by_date`, 
                    `wr`.`status` AS `order_status`
                FROM `writer_requests` `wr`
                JOIN `orders` `o` ON `wr`.`order_id` = `o`.`order_id`
                JOIN `order_details` `od` ON `wr`.`order_id` = `od`.`order_id`
                JOIN `users` `u` ON `o`.`customer_id` = `u`.`user_id`
                JOIN `services` `s` ON `od`.`service_id` = `s`.`service_id`
                WHERE `wr`.`writer_id` = '$writer_id' AND `wr`.`status` = 'in progress'
                ORDER BY `o`.`receive_by_date` DESC";

        $result = $ndb->db_query($sql);

        if ($result) {
            return $ndb->db_fetch_all();
        }
        return [];
    }

    public function getCompletedWriterRequests($writerID)
    {
        $ndb = new db_connection();

        $writer_id = mysqli_real_escape_string($ndb->db_conn(), $writerID);

        $sql = "SELECT 
                    `wr`.`order_id`, 
                    `u`.`name` AS `customer_name`, 
                    `s`.`service_name`, 
                    `o`.`instructions`, 
                    `o`.`receive_by_date`, 
                    `wr`.`status` AS `order_status`
                FROM `writer_requests` `wr`
                JOIN `orders` `o` ON `wr`.`order_id` = `o`.`order_id`
                JOIN `order_details` `od` ON `wr`.`order_id` = `od`.`order_id`
                JOIN `users` `u` ON `o`.`customer_id` = `u`.`user_id`
                JOIN `services` `s` ON `od`.`service_id` = `s`.`service_id`
                WHERE `wr`.`writer_id` = '$writer_id' AND `wr`.`status` = 'completed'
                ORDER BY `o`.`receive_by_date` DESC";

        $result = $ndb->db_query($sql);

        if ($result) {
            return $ndb->db_fetch_all();
        }
        return [];
    }

    // Accept an order and update its status to 'in progress'
    public function acceptOrder($writerID, $orderID)
    {
        $ndb = new db_connection();

        // Sanitize inputs to prevent SQL injection
        $writer_id = mysqli_real_escape_string($ndb->db_conn(), $writerID);
        $order_id = mysqli_real_escape_string($ndb->db_conn(), $orderID);

        // Update the order status to 'in progress'
        $sql = "UPDATE `writer_requests` 
            SET `status` = 'in progress'
            WHERE `order_id` = '$order_id' AND `writer_id` = '$writer_id'  AND `status` = 'pending'";

        $orderSql = "UPDATE `orders`
                    SET `order_status` = 'in progress'
                    WHERE `order_id` = '$order_id' AND `order_status` = 'pending'";

        // Execute both queries
        if ($ndb->db_query($sql) && $ndb->db_query($orderSql)) {
            return true;
        } else {
            return false;
        }
    }
}
