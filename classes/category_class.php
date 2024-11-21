<?php
// Connect to database class
require("../settings/db_class.php");

/**
 * Brand class to handle brand-related database functions.
 */
class Category extends db_connection
{
    // Add a new brand to the database
    public function addCategory($catName)
    {
        $ndb = new db_connection();

        $catName = mysqli_real_escape_string($ndb->db_conn(), $catName);
        
        // Prepare SQL statement
        $sql = "INSERT INTO `categories` (`cat_name`) VALUES ('$catName')";

        // Execute query and return result
        return $this->db_query($sql);    
    }

    public function deleteCategory($catID) {
        $ndb = new db_connection();

        // Prepare SQL statement
        $sql = "DELETE FROM `categories` WHERE `cat_id` = '$catID'";

        // Execute query and return result
        return $this->db_query($sql);
    }

    function getCategories() {
        $ndb = new db_connection();

        // Query to fetch categories
        $sql = "SELECT * FROM categories";
        $result = mysqli_query($ndb->db_conn(), $sql);
    
        // Initialize an empty array
        $categories = array();
    
        // Fetch and store the categories in the array
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $categories[] = $row;
            }
        }
    
        return $categories;
    }
    
}
?>
