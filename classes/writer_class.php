<?php
// Connect to database class
require("../settings/db_class.php");

/**
 * Writer class to handle writer-related database functions.
 */
class Writer extends db_connection
{
    // Add a new brand to the database
    public function addWriter($writerName, $yearsOfExperience, $writerSpeciality)
    {
        $ndb = new db_connection();

        $name = mysqli_real_escape_string($ndb->db_conn(), $writerName);
        $experience = mysqli_real_escape_string($ndb->db_conn(), $yearsOfExperience);
        $speciality = mysqli_real_escape_string($ndb->db_conn(), $writerSpeciality);

        // Prepare SQL statement
        $sql = "INSERT INTO `writers` (`writer_name`, `years_of_experience`, `speciality`) VALUES ('$name', '$experience', '$speciality')";

        // Execute query and return result
        return $this->db_query($sql);    
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
        $sql = "SELECT * FROM `writers`";

        $result = mysqli_real_escape_string($ndb->db_conn(), $sql);

        // Execute query and return result
        return $this->db_fetch_all($result);
    }
}
?>
