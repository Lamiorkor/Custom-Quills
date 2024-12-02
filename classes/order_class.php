<?php
// Connect to database class
require("../settings/db_class.php");

/**
 * Orders class to handle order-related database functions.
 */
class Orders extends db_connection
{
    public function addOrder($customerID, $invoiceNumber, $orderDate, $receiveDate, $totalAmt)
    {
        $ndb = new db_connection();

        $customer_id = mysqli_real_escape_string($ndb->db_conn(), $customerID);
        $invoice_no = mysqli_real_escape_string($ndb->db_conn(), $invoiceNumber);
        $order_date = mysqli_real_escape_string($ndb->db_conn(), $orderDate);
        $receive_date = mysqli_real_escape_string($ndb->db_conn(), $receiveDate);
        $total_amount = mysqli_real_escape_string($ndb->db_conn(), $totalAmt);

        // Prepare SQL statement
        $sql = "INSERT INTO `orders` (`customer_id`, `invoice_no`, `order_date`, `receive_by_date`, `total_amount`) 
                VALUES ('$customer_id', '$invoice_no', '$order_date', '$receive_date', '$total_amount')";

        if ($ndb->db_query($sql)) {
            $insert_id = $ndb->get_insert_id();
            if($insert_id > 0) {
                return $insert_id;
            } else {
                error_log("Insert ID not found. Check DB connection");
                return false;
            }
        } else {
            error_log("Error adding order: ". mysqli_error($ndb->db_conn()));
            return false;
        }
    }

    public function addOrderDetails($orderID, $serviceID, $writerID, $quantity)
    {
        $ndb = new db_connection();

        $order_id = mysqli_real_escape_string($ndb->db_conn(), $orderID);
        $service_id = mysqli_real_escape_string($ndb->db_conn(), $serviceID);
        $writer_id = mysqli_real_escape_string($ndb->db_conn(), $writerID);
        $qty = mysqli_real_escape_string($ndb->db_conn(), $quantity);
        
        // Prepare SQL statement
        $sql = "INSERT INTO `order_details` (`order_id`, `service_id`, `writer_id`, `qty`) 
                VALUES ('$order_id', '$service_id', '$writer_id', '$qty')";

        // Execute query and return result
        return $this->db_query($sql);    
    }


    public function deleteOrder($orderID) {
        $ndb = new db_connection();

        // Prepare SQL statement
        $sql = "DELETE FROM `orders` WHERE `order_id` = '$orderID'";

        // Execute query and return result
        return $this->db_query($sql);
    }

    public function getOrders() {
        $ndb = new db_connection();

        // Query to fetch categories
        $sql = "SELECT * FROM `orders`";
        $result = mysqli_query($ndb->db_conn(), $sql);
    
        // Initialize an empty array
        $orders = array();
    
        // Fetch and store the categories in the array
        if ($result) {
            while ($row = $ndb->db_fetch_all()) {
                $orders[] = $row;
            }
        }
        return $orders;
    }
    
    function getUsersOrders($userID) {
        $ndb = new db_connection();

        $user_id = mysqli_real_escape_string($ndb->db_conn(), $userID);

        // Query to fetch categories
        $sql = "SELECT * FROM `orders` WHERE `user_id` = $user_id";
        $result = mysqli_query($ndb->db_conn(), $sql);
    
        // Initialize an empty array
        $orders = array();
    
        // Fetch and store the categories in the array
        if ($result) {
            while ($row = $ndb->db_fetch_all()) {
                $orders[] = $row;
            }
        }
        return $orders;
    }
}
?>
