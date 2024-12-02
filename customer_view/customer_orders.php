<?php
session_start();
include('../controllers/order_controller.php');
$user_id = $_SESSION['user_id'];
$orders = getUsersOrdersController($user_id);

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
        <h2 class="italic text-xl mt-2">Poetry made for you</h2>
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
        <h3 class="text-2xl font-semibold text-center">Your Orders</h3>
        <div class="mt-8 bg-white shadow-md rounded-lg p-6">
            <table class="table-auto w-full text-left">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm">
                        <th class="px-6 py-3 border">Invoice Number</th>
                        <th class="px-6 py-3 border">Order Date</th>
                        <th class="px-6 py-3 border">Status</th>
                        <th class="px-6 py-3 border">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($orders)) {
                        foreach ($orders as $order) {
                            echo "
                            <tr class='text-gray-700 border-t hover:bg-gray-100'>
                                <td class='px-6 py-3 border'>{$order['invoice_no']}</td>
                                <td class='px-6 py-3 border'>{$order['order_date']}</td>
                                <td class='px-6 py-3 border'>{$order['order_status']}</td>
                                <td class='px-6 py-3 border'>
                                    <form action='../actions/delete_order_action.php' method='POST' class='inline-block'>
                                        <input type='hidden' name='orderID' value='{$order['order_id']}'>
                                        <button type='submit' class='bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition'>Delete</button>
                                    </form>
                                </td>
                            </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4' class='text-center text-gray-500 py-4'>No orders found.</td></tr>";
                    }
                    ?>
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
