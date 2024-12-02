<?php
// Include the order class
include("../classes/order_class.php");

function addOrderController($customerID, $invoiceNumber, $orderDate, $receiveDate, $totalAmt) {
    // Create an instance of the Order class
    $newOrder = new Orders();

    // Return the addOrder method
    return $newOrder->addOrder($customerID, $invoiceNumber, $orderDate, $receiveDate, $totalAmt);
}

function addOrderDetailsController($orderID, $serviceID, $writerID, $quantity) {
    // Create an instance of the Order class
    $newOrderDetails = new Orders();

    // Return the addBrand method
    return $newOrderDetails->addOrderDetails($orderID, $serviceID, $writerID, $quantity);
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

function getUsersOrdersController($userID) {
    // Create an instance of the Order class
    $orders = new Orders();

    // Return the getOrders method
    return $orders->getUsersOrders($userID);
}

?>