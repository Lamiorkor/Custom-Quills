<?php
// Include the order class
include("../classes/order_class.php");

function addOrderController($customerID,  $invoiceNumber, $receiveByDate, $expressDelivery, $expressCharge, $baseTotal, $totalAmount, $instructions) {
    $order = new Orders();
    return $order->addOrder($customerID,  $invoiceNumber, $receiveByDate, $expressDelivery, $expressCharge, $baseTotal, $totalAmount, $instructions);
}


function addOrderDetailsController($orderID, $serviceID, $writerID, $qty) {
    $order = new Orders();
    return $order->addOrderDetails($orderID, $serviceID, $writerID, $qty);
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


function getServicePriceController($serviceID) {
    $order = new Orders();
    return $order->getServicePrice($serviceID);
}

function getOrderDetailsController($orderID) {
    $order = new Orders();
    return $order->getOrderDetails($orderID);
}

function updateOrderStatusController($order_id, $status) {
    $order = new Orders();
    return $order->updateOrderStatus($order_id, $status);
}

function deleteOrderDetailsController($order_id) {
    $order = new Orders();
    return $order->deleteOrderDetails($order_id);
}

function getCustomerOrderDetailsController($orderID)
{
    $order = new Orders();
    return $order->getCustomerOrderDetails($orderID);
}

function getUsersOrdersByStatusController($userID, $status) {
    $orders = new Orders();
    return $orders->getUsersOrdersByStatus($userID, $status);
}


?>