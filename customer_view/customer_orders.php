<?php
session_start();
include('../controllers/order_controller.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch orders by status
$pendingOrders = getUsersOrdersByStatusController($user_id, 'pending');
$inProgressOrders = getUsersOrdersByStatusController($user_id, 'in-progress');
$completedOrders = getUsersOrdersByStatusController($user_id, 'completed');
$cancelledOrders = getUsersOrdersByStatusController($user_id, 'cancelled');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Custom Quills - View Orders</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex flex-col min-h-screen bg-gray-100">

    <!-- Header Section -->
    <header class="bg-blue-500 text-white p-6 text-center">
        <h1 class="text-3xl font-bold">Custom Quills</h1>
        <h2 class="italic text-xl mt-2">Your Orders</h2>
    </header>

    <!-- Navigation Bar -->
    <nav class="bg-white shadow-md">
        <div class="max-w-7xl mx-auto px-6 py-3">
            <ul class="flex justify-center space-x-6">
                <li><a href="customer_services.php" class="text-blue-500 hover:text-blue-700">Services</a></li>
                <li><a href="customer_writers.php" class="text-blue-500 hover:text-blue-700">Writers</a></li>
                <li><a href="customer_orders.php" class="text-blue-500 hover:text-blue-700">Orders</a></li>
                <li><a href="customer_contact.php" class="text-blue-500 hover:text-blue-700">Contact</a></li>
                <li><a href="customer_messages.php" class="text-blue-500 hover:text-blue-700">Messages</a></li>
                <li><a href="../actions/logout_action.php" class="text-blue-500 hover:text-blue-700">Logout</a></li>
            </ul>
        </div>
    </nav>

    <!-- Main Content Section -->
    <main class="max-w-7xl mx-auto px-6 py-10 flex-1">
        <h3 class="text-2xl font-semibold text-center mb-6">Your Orders</h3>

        <!-- Pending/In Progress Orders -->
        <div class="bg-white shadow-md rounded-lg p-6 mb-8">
            <h4 class="text-lg font-semibold mb-4">Pending & In-Progress Orders</h4>
            <table class="table-auto w-full text-left">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm">
                        <th class="px-6 py-3 border">Invoice Number</th>
                        <th class="px-6 py-3 border">Order Date</th>
                        <th class="px-6 py-3 border">Receive By</th>
                        <th class="px-6 py-3 border">Total Amount</th>
                        <th class="px-6 py-3 border">Order Status</th>
                        <th class="px-6 py-3 border">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($pendingOrders) || !empty($inProgressOrders)): ?>
                        <?php foreach (array_merge($pendingOrders, $inProgressOrders) as $order): ?>
                            <tr class="text-gray-700 border-t hover:bg-gray-100">
                                <td class="px-6 py-3 border"><?php echo htmlspecialchars($order['invoice_no']); ?></td>
                                <td class="px-6 py-3 border"><?php echo htmlspecialchars($order['date_ordered']); ?></td>
                                <td class="px-6 py-3 border"><?php echo htmlspecialchars($order['receive_by_date']); ?></td>
                                <td class="px-6 py-3 border">GHS <?php echo htmlspecialchars($order['total_amount']); ?></td>
                                <td class="px-6 py-3 border"><?php echo htmlspecialchars($order['order_status']); ?></td>
                                <td class="px-6 py-3 border">
                                    <button class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">View Details</button>
                                    <a href="order_confirmation.php?order_id=<?php echo $order['order_id']; ?>" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition inline-block">Pay</a>
                                    <a href="../actions/cancel_order_action.php?order_id=<?php echo $order['order_id']; ?>"
                                        class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition inline-block">
                                        Cancel
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center text-gray-500 py-4">No pending or in-progress orders found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Completed Orders -->
        <div class="bg-white shadow-md rounded-lg p-6 mb-8">
            <h4 class="text-lg font-semibold mb-4">Completed Orders</h4>
            <table class="table-auto w-full text-left">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm">
                        <th class="px-6 py-3 border">Invoice Number</th>
                        <th class="px-6 py-3 border">Order Date</th>
                        <th class="px-6 py-3 border">Receive By</th>
                        <th class="px-6 py-3 border">Total Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($completedOrders)): ?>
                        <?php foreach ($completedOrders as $order): ?>
                            <tr class="text-gray-700 border-t hover:bg-gray-100">
                                <td class="px-6 py-3 border"><?php echo htmlspecialchars($order['invoice_no']); ?></td>
                                <td class="px-6 py-3 border"><?php echo htmlspecialchars($order['date_ordered']); ?></td>
                                <td class="px-6 py-3 border"><?php echo htmlspecialchars($order['receive_by_date']); ?></td>
                                <td class="px-6 py-3 border">GHS <?php echo htmlspecialchars($order['total_amount']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="text-center text-gray-500 py-4">No completed orders found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Cancelled Orders -->
        <div class="bg-white shadow-md rounded-lg p-6">
            <h4 class="text-lg font-semibold mb-4">Cancelled Orders</h4>
            <table class="table-auto w-full text-left">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm">
                        <th class="px-6 py-3 border">Invoice Number</th>
                        <th class="px-6 py-3 border">Order Date</th>
                        <th class="px-6 py-3 border">Receive By</th>
                        <th class="px-6 py-3 border">Total Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($cancelledOrders)): ?>
                        <?php foreach ($cancelledOrders as $order): ?>
                            <tr class="text-gray-700 border-t hover:bg-gray-100">
                                <td class="px-6 py-3 border"><?php echo htmlspecialchars($order['invoice_no']); ?></td>
                                <td class="px-6 py-3 border"><?php echo htmlspecialchars($order['date_ordered']); ?></td>
                                <td class="px-6 py-3 border"><?php echo htmlspecialchars($order['receive_by_date']); ?></td>
                                <td class="px-6 py-3 border">GHS <?php echo htmlspecialchars($order['total_amount']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="text-center text-gray-500 py-4">No cancelled orders found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </main>

    <!-- Footer Section -->
    <footer class="bg-blue-500 text-white py-6">
        <div class="container mx-auto px-6 text-center">
            <p>&copy; <?php echo date("Y"); ?> Custom Quills. All rights reserved.</p>
        </div>
    </footer>

</body>

</html>