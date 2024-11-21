<?php
// Connect to database class
require("../settings/db_class.php");

/**
 * Orders class to handle order-related database functions.
 */
class Orders extends db_connection
{
    public function addOrder($customerID, $invoiceNumber, $orderDate, $status)
    {
        $ndb = new db_connection();

        $customer_id = mysqli_real_escape_string($ndb->db_conn(), $customerID);
        $invoice_no = mysqli_real_escape_string($ndb->db_conn(), $invoiceNumber);
        $order_date = mysqli_real_escape_string($ndb->db_conn(), $orderDate);
        $order_status = mysqli_real_escape_string($ndb->db_conn(), $status);

        
        // Prepare SQL statement
        $sql = "INSERT INTO `orders` (`customer_id`, `invoice_no`, `order_date`, `order_status`) VALUES ('$customer_id', '$invoice_no', '$order_date', '$order_status')";

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

    public function addOrderDetails($orderID, $serviceID, $quantity)
    {
        $ndb = new db_connection();

        $order_id = mysqli_real_escape_string($ndb->db_conn(), $orderID);
        $service_id = mysqli_real_escape_string($ndb->db_conn(), $serviceID);
        $qty = mysqli_real_escape_string($ndb->db_conn(), $quantity);

        
        // Prepare SQL statement
        $sql = "INSERT INTO `orderdetails` (`order_id`, `service_id`, `qty`) VALUES ('$order_id', '$service_id', '$qty')";

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

    function getOrders() {
        $ndb = new db_connection();

        // Query to fetch categories
        $sql = "SELECT * FROM `orders`";
        $result = mysqli_query($ndb->db_conn(), $sql);
    
        // Initialize an empty array
        $orders = array();
    
        // Fetch and store the categories in the array
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $orders[] = $row;
            }
        }
    
        return $orders;
    }
    
}
?>
