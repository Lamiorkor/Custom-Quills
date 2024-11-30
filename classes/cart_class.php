<?php
// Connect to database class
require("../settings/db_class.php");

/**
 * Cart class to handle cart-related database functions.
 */
class Cart extends db_connection {
    // Add a new cart to the database
    public function addToCart($serviceID, $customerID, $writerID, $quantity) {
        $ndb = new db_connection();

        $service_id = mysqli_real_escape_string($ndb->db_conn(), $serviceID);
        $customer_id = mysqli_real_escape_string($ndb->db_conn(), $customerID);
        $writer_id = mysqli_real_escape_string($ndb->db_conn(), $writerID);
        $qty = mysqli_real_escape_string($ndb->db_conn(), $quantity);

        $check = "SELECT * FROM `cart` WHERE `service_id` = '$service_id' AND `customer_id` = '$customer_id'";
        $result = $this->db_fetch_one($check);

        if($result) {
            $newQty = $result['qty'] + $qty;
            $update = "UPDATE `cart` SET `qty` = '$newQty' WHERE `service_id` = '$service_id' AND `customer_id` = '$customer_id'";

            return $this->db_query($update);
        } else {
            // If cart item doesn't already exist, prepare SQL statement
            $sql = "INSERT INTO `cart` (`service_id`, `customer_id`, `writer_id`, `qty`) 
                    VALUES ('$service_id', '$customer_id', '$writer_id', '$qty')";

            // Execute query and return result
            return $this->db_query($sql); 
        }   
    }

    public function getCartItems($customerID) {
        $ndb = new db_connection();

        $customer_id = mysqli_real_escape_string($ndb->db_conn(), $customerID);

        // Prepare SQL statement
        $sql = "SELECT `cart`.`service_id`, `cart`.`writer_id`, `cart`.`qty`, `services`.`service_name` FROM `cart` 
                JOIN `services` ON `cart`.`service_id` = `services`.`service_id`
                WHERE `cart`.`customer_id` = '$customer_id'";
    
        // Execute the query and fetch all results
        $result = $ndb->db_query($sql);

        if($result) {
            return $ndb->db_fetch_all();
        }
    
        return [];
    }    


    public function deleteCartItem($serviceID, $customerID) {
        $ndb = new db_connection();

        // Prepare SQL statement
        $sql = "DELETE FROM `cart` WHERE `s_id` = '$serviceID' AND `c_id` = '$customerID'";

        // Execute query and return result
        return $ndb->db_query($sql);
    }

    public function getOneCartItem($serviceID, $customerID) {
        $ndb = new db_connection();

        // Escape the service ID to prevent SQL injection attacks
        $service_id = $ndb->db_conn()->real_escape_string($serviceID);
        $customer_id = $ndb->db_conn()->real_escape_string($customerID);

        // Prepare SQL statement with a placeholder for the service ID
        $sql = "SELECT `cart`.*, `services`.`service_name` FROM `cart` 
                JOIN `services` ON `cart`.`service_id` = `services`.`service_id` 
                WHERE `cart`.`service_id` = '$service_id' AND `cart`.`customer_id` = '$customer_id'";    

        // Execute the query using the db_query method and fetch the result
        if ($ndb->db_query($sql)) {
            return $ndb->db_fetch_one($sql); // Fetch and return the single record
        } else {
            return false; // Return false if the query fails
        }
    }
    
    function increaseCartItemQty($serviceID, $customerID, $quantity) {
        $ndb = new db_connection();

        $service_id = mysqli_real_escape_string($ndb->db_conn(), $serviceID);
        $customer_id = mysqli_real_escape_string($ndb->db_conn(), $customerID);
        $qty = mysqli_real_escape_string($ndb->db_conn(), $quantity);

        $check = "SELECT * FROM `cart` WHERE `s_id` = '$service_id' AND `c_id` = '$customer_id'";
        $result = $this->db_fetch_one($check);

        if($result) {
            $newQty = $result['qty'] + $qty;
            // Prepare SQL query
            $update = "UPDATE `cart` SET `qty` = '$newQty' WHERE `s_id` = '$service_id' AND `c_id` = '$customer_id'";
            // Execute the query
            return $this->db_query($update);
        } else {
            // If cart item doesn't already exist, return false
            return false;
        }
    }

    function decreaseCartItemQty($serviceID, $customerID, $quantity) {
        $ndb = new db_connection();

        $service_id = mysqli_real_escape_string($ndb->db_conn(), $serviceID);
        $customer_id = mysqli_real_escape_string($ndb->db_conn(), $customerID);
        $qty = mysqli_real_escape_string($ndb->db_conn(), $quantity);

        $check = "SELECT * FROM `cart` WHERE `s_id` = '$service_id' AND `c_id` = '$customer_id'";
        $result = $this->db_fetch_one($check);

        if($result && $result['qty'] > 0) {
            $newQty = $result['qty'] - $qty;
            // Prepare SQL query
            $update = "UPDATE `cart` SET `qty` = '$newQty' WHERE `s_id` = '$service_id' AND `c_id` = '$customer_id'";
            // Execute the query
            return $this->db_query($update);
        } else {
            // If cart item doesn't already exist, return false
            return false;
        }
    }
}
?>
