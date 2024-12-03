<?php

require_once ("../settings/db_class.php");

class Payment extends db_connection {
    public function addPayment($amount, $customerID, $orderID, $currency, $reference, $paymentDate) {
        $ndb = new db_connection();

        $amt = mysqli_real_escape_string($ndb->db_conn(), $amount);
        $customer_id = mysqli_real_escape_string($ndb->db_conn(), $customerID);
        $order_id = mysqli_real_escape_string($ndb->db_conn(), $orderID);
        $order_currency = mysqli_real_escape_string($ndb->db_conn(), $currency);
        $order_reference = mysqli_real_escape_string($ndb->db_conn(), $reference);
        $payment_date = mysqli_real_escape_string($ndb->db_conn(), $paymentDate);

        $sql = "INSERT INTO payment (amt, customer_id, order_id, currency, reference, payment_date)
                VALUES ('$amt', '$customer_id', '$order_id', '$order_currency', '$order_reference', '$payment_date')";

        return $ndb->db_query($sql);
    }
}


?>