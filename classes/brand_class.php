<?php
// Connect to database class
require("../settings/db_class.php");

/**
 * Brand class to handle brand-related database functions.
 */
class Brand extends db_connection
{
    // Add a new brand to the database
    public function addBrand($brandName)
    {
        $ndb = new db_connection();

        $brandName = mysqli_real_escape_string($ndb->db_conn(), $brandName);
        
        // Prepare SQL statement
        $sql = "INSERT INTO `brands` (`brand_name`) VALUES ('$brandName')";

        // Execute query and return result
        return $this->db_query($sql);    
    }

    public function deleteBrand($brandID) {
        $ndb = new db_connection();

        // Prepare SQL statement
        $sql = "DELETE FROM `brands` WHERE `brand_id` = '$brandID'";

        // Execute query and return result
        return $this->db_query($sql);
    }

    public function getBrands() {
        $ndb = new db_connection();

        // Prepare SQL statement
        $sql = "SELECT * FROM `brands`";

        $result = mysqli_real_escape_string($ndb->db_conn(), $sql);

        // Execute query and return result
        return $this->db_fetch_all($result);
    }
}
?>
