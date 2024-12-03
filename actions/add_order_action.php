<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

require_once('../controllers/order_controller.php');
require_once('../controllers/writer_controller.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: ../view/login.php");
    exit();
}

$customerID = $_SESSION['user_id'];
$invoiceNumber = rand(00001, 99999);
$serviceID = $_POST['service_id'];
$writerID = $_POST['writer_id'];
$receiveByDate = $_POST['receive_by_date'];
$expressDelivery = isset($_POST['express_delivery']) ? (int)$_POST['express_delivery'] : 0; // Ensure 0 or 1 is stored
$instructions = $_POST['instructions'];
$qty = 1; // Default quantity

// Calculate total amount
$servicePrice = getServicePriceController($serviceID); // Fetch service price
$expressCharge = $expressDelivery ? 30.00 : 0.00; // If express delivery is checked, apply the additional charge
$baseTotal = $servicePrice * $qty;
$totalAmount = $baseTotal + $expressCharge;

// Create order
$orderID = addOrderController($customerID, $invoiceNumber, $receiveByDate, $expressDelivery, $expressCharge, $baseTotal, $totalAmount, $instructions);

// Add order details
if ($orderID) {
    addOrderDetailsController($orderID, $serviceID, $writerID, $qty);

    $orderStatus = 'pending';
    $dateCreated = date('Y-m-d H:i:s');

    // Add writer request to database if writer is selected
    addWriterRequestsController($orderID, $writerID, $orderStatus, $dateCreated);
    header("Location: ../customer_view/customer_orders.php?success=Order placed successfully!");
} else {
    header("Location: ../customer_view/add_order.php?error=Failed to place order.");
}
?>
