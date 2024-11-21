<?php
// Include the order class
include("../classes/order_class.php");

function addOrderController($customerID, $invoiceNumber, $orderDate, $status) {
    // Create an instance of the Order class
    $newOrder = new Orders();

    // Return the addOrder method
    return $newOrder->addOrder($customerID, $invoiceNumber, $orderDate, $status);
}

function addOrderDetailsController($orderID, $serviceID, $quantity) {
    // Create an instance of the Order class
    $newOrderDetails = new Orders();

    // Return the addBrand method
    return $newOrderDetails->addOrderDetails($orderID, $serviceID, $quantity);
}

function deleteOrderController($orderID) {
    $order = new Orders();

    // Return the deleteOrder method
    return $order->deleteOrder($orderID);
}

function getOrdersController() {
    // Create an instance of the Order class
    $orders = new Orders();

    // Return the getOrders method
    return $orders->getOrders();
}

?>