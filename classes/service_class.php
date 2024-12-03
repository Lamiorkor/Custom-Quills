<?php
// Connect to database class
require("../settings/db_class.php");

/**
 * Brand class to handle brand-related database functions.
 */
class Service extends db_connection
{
    // Add a new brand to the database
    public function addService($serviceName, $serviceCategory, $servicePrice, $serviceDescription, $serviceKeywords)
    {
        $ndb = new db_connection();

        $serviceName = mysqli_real_escape_string($ndb->db_conn(), $serviceName);
        $serviceCategory = mysqli_real_escape_string($ndb->db_conn(), $serviceCategory);
        $servicePrice = mysqli_real_escape_string($ndb->db_conn(), $servicePrice);
        $serviceDescription = mysqli_real_escape_string($ndb->db_conn(), $serviceDescription);
        $serviceKeywords = mysqli_real_escape_string($ndb->db_conn(), $serviceKeywords);

        
        // Prepare SQL statement
        $sql = "INSERT INTO `services` (`service_name`, `service_category`, `service_price`, `service_desc`, `service_keywords`) 
                VALUES ('$serviceName', '$serviceCategory', '$servicePrice', '$serviceDescription', '$serviceKeywords')";

        // Execute query and return result
        return $this->db_query($sql);    
    }

    public function deleteService($serviceID) {
        $ndb = new db_connection();

        // Prepare SQL statement
        $sql = "DELETE FROM `services` WHERE `service_id` = '$serviceID'";

        // Execute query and return result
        return $ndb->db_query($sql);
    }

    public function getServices() {
        $ndb = new db_connection();

        // Prepare SQL statement
        $sql = "SELECT `services`.*, `categories`.`cat_name` FROM `services` 
                JOIN `categories` ON `services`.`service_category` = `categories`.`cat_id`";
    
        // Execute the query and fetch all results
        $services = $ndb->db_query($sql);

        if($services) {
            return $ndb->db_fetch_all();
        }
  
      return [];
  }    

    public function getOneService($serviceID) {
        $ndb = new db_connection();

        // Escape the service ID to prevent SQL injection attacks
        $service_id = $ndb->db_conn()->real_escape_string($serviceID);

        // Prepare SQL statement with a placeholder for the service ID
        $sql = "SELECT `services`.*, `categories`.`cat_name` FROM `services` 
                JOIN `categories` ON `services`.`service_category` = `categories`.`cat_id` 
                WHERE `services`.`service_id` = '$service_id'";    

        // Execute the query using the db_query method and fetch the result
        if ($ndb->db_query($sql)) {
            return $ndb->db_fetch_one($sql); // Fetch and return the single record
        } else {
            return false; // Return false if the query fails
        }
    }
    
    function editService($serviceID, $serviceName, $serviceCategory, $servicePrice, $serviceDescription, $serviceKeywords) {
        $ndb = new db_connection();

        $serviceID = mysqli_real_escape_string($ndb->db_conn(), $serviceID);
        $serviceName = mysqli_real_escape_string($ndb->db_conn(), $serviceName);
        $serviceCategory = mysqli_real_escape_string($ndb->db_conn(), $serviceCategory);
        $servicePrice = mysqli_real_escape_string($ndb->db_conn(), $servicePrice);
        $serviceDescription = mysqli_real_escape_string($ndb->db_conn(), $serviceDescription);
        $serviceKeywords = mysqli_real_escape_string($ndb->db_conn(), $serviceKeywords);

        // Prepare SQL query
        $sql = "UPDATE `services` SET `service_name` = '$serviceName', `service_category` = '$serviceCategory', 
                `service_price` = '$servicePrice', `service_desc` = '$serviceDescription', 
                `service_keywords` = '$serviceKeywords' WHERE `service_id` = '$serviceID'";

        // Execute the query
        return $this->db_query($sql);
    }
}
?>
