<?php
// Connect to database class
require("../settings/db_class.php");

/**
 * Writer class to handle writer-related database functions.
 */
class Writer extends db_connection
{
    // Add a new brand to the database
    public function addWriter($userID, $yearsOfExperience, $speciality, $rating, $availability) {
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
    

    public function deleteWriter($writerID) {
        $ndb = new db_connection();

        // Prepare SQL statement
        $sql = "DELETE FROM `writers` WHERE `writer_id` = '$writerID'";

        // Execute query and return result
        return $this->db_query($sql);
    }

    public function getWriters() {
        $ndb = new db_connection();

        // Prepare SQL statement
        $sql = "SELECT `writers`.*, `users`.`name` 
                FROM `writers`
                JOIN `users` ON `users`.`user_id` = `writers`.`user_id`";

        $result = mysqli_real_escape_string($ndb->db_conn(), $sql);

        // Execute query and return result
        $result = $ndb->db_query($sql);

        if($result) {
            return $ndb->db_fetch_all();
        }
    
        return [];
    }

    public function updateWriter($writerID, $writerName, $yearsOfExperience, $writerSpeciality, $writerRating, $writerAvailability) {
        $ndb = new db_connection();

        $writer_id = mysqli_real_escape_string($ndb->db_conn(), $writerID);
        $name = mysqli_real_escape_string($ndb->db_conn(), $writerName);
        $experience = mysqli_real_escape_string($ndb->db_conn(), $yearsOfExperience);
        $speciality = mysqli_real_escape_string($ndb->db_conn(), $writerSpeciality);
        $rating = mysqli_real_escape_string($ndb->db_conn(), $writerRating);
        $availability = mysqli_real_escape_string($ndb->db_conn(), $writerAvailability);

        // Prepare SQL statement
        $sql = "UPDATE `writers` SET `writer_name` = '$name', `years_of_experience` = '$experience', 
                `speciality` = '$speciality', `rating` = '$rating', `availability_status` = '$availability' 
                WHERE `writer_id` = '$writer_id'";

        // Execute query and return result
        $result = $ndb->db_query($sql);

        if($result) {
            return $ndb->db_fetch_all();
        }

        return [];
    }

    public function getOneWriter($writerID) {
        // Sanitize writerID input to prevent SQL injection
        $ndb = new db_connection();
        $writerID = mysqli_real_escape_string($ndb->db_conn(), $writerID);
    
        // SQL query to select a single writer by ID
        $sql = "SELECT * FROM `writers` WHERE `writer_id` = '$writerID' LIMIT 1";
        
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
    
    
}

?>
