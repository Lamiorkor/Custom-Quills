<?php
// Connect to database class
require("../settings/db_class.php");

/**
 * Orders class to handle order-related database functions.
 */
class Orders extends db_connection
{
    public function addOrder($customerID,  $invoiceNumber, $receiveByDate, $expressDelivery, $expressCharge, $baseTotal, $totalAmount, $instructions)
    {
        $ndb = new db_connection();

        $customer_id = mysqli_real_escape_string($ndb->db_conn(), $customerID);
        $invoice_no = mysqli_real_escape_string($ndb->db_conn(), $invoiceNumber);
        $receive_date = mysqli_real_escape_string($ndb->db_conn(), $receiveByDate);
        $express_delivery = mysqli_real_escape_string($ndb->db_conn(), $expressDelivery);
        $express_charge = mysqli_real_escape_string($ndb->db_conn(), $expressCharge);
        $base_total = mysqli_real_escape_string($ndb->db_conn(), $baseTotal);
        $totalAmt = mysqli_real_escape_string($ndb->db_conn(), $totalAmount);
        $order_instructions = mysqli_real_escape_string($ndb->db_conn(), $instructions);


        // Prepare SQL statement
        $sql = "INSERT INTO `orders` (`customer_id`, `invoice_no`, `receive_by_date`, `express_delivery`, `express_charge`, 
                                      `base_total_amount`, `total_amount`, `instructions`, `order_status`) 
                VALUES ('$customer_id', '$invoice_no', '$receive_date', '$express_delivery', '$express_charge', '$base_total', 
                        '$totalAmt', '$order_instructions', 'pending')";

        if ($ndb->db_query($sql)) {
            $insert_id = $ndb->get_insert_id();
            if ($insert_id > 0) {
                return $insert_id;
            } else {
                error_log("Insert ID not found. Check DB connection");
                return false;
            }
        } else {
            error_log("Error adding order: " . mysqli_error($ndb->db_conn()));
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


    public function deleteOrder($orderID)
    {
        $ndb = new db_connection();

        // Prepare SQL statement
        $sql = "DELETE FROM `orders` WHERE `order_id` = '$orderID'";

        // Execute query and return result
        return $this->db_query($sql);
    }

    public function getOrders()
    {
        $ndb = new db_connection();

        // Query to fetch categories
        $sql = "SELECT * FROM `orders`";
        $result = $ndb->db_query($sql);

        if ($result) {
            // Fetch all orders from the result set
            $orders = $ndb->db_fetch_all(); // Fetch all the rows
        }

        return $orders;
    }

    function getUsersOrders($userID)
    {
        $ndb = new db_connection();

        $user_id = mysqli_real_escape_string($ndb->db_conn(), $userID);

        // Query to fetch orders
        $sql = "SELECT * FROM `orders` WHERE `customer_id` = '$user_id'";
        $result = $ndb->db_query($sql);

        if ($result) {
            // Fetch all orders from the result set
            $orders = $ndb->db_fetch_all(); // Fetch all the rows
        }

        return $orders;
    }


    public function getServicePrice($serviceID)
    {
        $ndb = new db_connection();

        $service_id = mysqli_real_escape_string($ndb->db_conn(), $serviceID);

        $sql = "SELECT `service_price` FROM `services` WHERE `service_id` = '$service_id'";
        $result = $ndb->db_fetch_one($sql);
        return $result['service_price'] ?? 0.00;
    }

    public function getOrderDetails($orderID) {
        $ndb = new db_connection();
        $order_id = mysqli_real_escape_string($ndb->db_conn(), $orderID);

        // Prepare SQL statement
        $sql = "SELECT * FROM `orders` WHERE `order_id` = '$order_id' LIMIT 1";

        // Execute query and return the result
        $result = $ndb->db_query($sql);

        if ($result) {
            return $ndb->db_fetch_one($sql);
        }
        return [];
    }

    public function updateOrderStatus($orderID, $status) {
        $ndb = new db_connection();

        $order_id = mysqli_real_escape_string($ndb->db_conn(), $orderID);
        $order_status = mysqli_real_escape_string($ndb->db_conn(), $status);

        $sql = "UPDATE `orders` SET `order_status` = '$order_status' WHERE `order_id` = '$order_id'";
        return $ndb->db_query($sql);
    }

    public function deleteOrderDetails($orderID) {
        $ndb = new db_connection();

        $order_id = mysqli_real_escape_string($ndb->db_conn(), $orderID);

        $sql = "DELETE FROM `order_details` WHERE `order_id` = '$order_id'";
        return $ndb->db_query($sql);
    }

    public function getCustomerOrderDetails($orderID) 
    {
        $ndb = new db_connection();

        $order_id = mysqli_real_escape_string($ndb->db_conn(), $orderID);

        $sql = "SELECT `od`.`order_id`, `od`.`service_id`, `od`.`writer_id`, `od`.`qty`, `s`.`service_name`, 
                     `s`.`service_price`, `o`.`customer_id`, `u`.`name`, `u`.`email` 
                FROM `order_details` `od` 
                JOIN `services` `s` ON `od`.`service_id` = `s`.`service_id`
                JOIN `orders` `o` ON `od`.`order_id` = `o`.`order_id`
                JOIN `customers` `c` ON `o`.`customer_id` = `c`.`customer_id`
                JOIN `users` `u` ON `c`.`user_id` = `u`.`user_id`
                WHERE `od`.`order_id` = '$order_id'";

        $result = $ndb->db_query($sql);

        if ($result) {
            return $ndb->db_fetch_one($sql);
        }

        return [];
    }

    public function getUsersOrdersByStatus($userID, $status) {
        $ndb = new db_connection();
    
        $user_id = mysqli_real_escape_string($ndb->db_conn(), $userID);
        $order_status = mysqli_real_escape_string($ndb->db_conn(), $status);
    
        // Query to fetch orders filtered by status
        $sql = "SELECT * FROM `orders` WHERE `customer_id` = '$user_id' AND `order_status` = '$order_status'";
        $result = $ndb->db_query($sql);
    
        if ($result) {
            return $ndb->db_fetch_all(); // Fetch all rows
        }
    
        return [];
    }
    
}

?>
