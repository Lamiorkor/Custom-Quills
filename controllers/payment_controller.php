<?php
require_once ("../classes/payment_class.php");

function addPaymentController($amount, $customer_id, $order_id, $currency, $reference, $payment_date) {
    $payment = new Payment();
    return $payment->addPayment($amount, $customer_id, $order_id, $currency, $reference, $payment_date);
}


?>