<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
$user_name = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : null;
$role = $_SESSION['user_role'];

// Check if user is logged in and has the correct role
if (!$user_name) {
    echo "User is not logged in";
    header("Location:../view/login.php");
    exit();
} elseif ($role === 'customer') {
    header("Location:../customer_view/customer_dashboard.php");
    exit();
} elseif ($role === 'writer') {
    header("Location:../writer_view/writer_dashboard.php");
    exit();
}

// Include orders controller
require_once('../controllers/order_controller.php');
$orders = getOrdersController();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Orders - Custom Quills</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body class="flex bg-gray-100 font-sans leading-normal tracking-normal min-h-screen">
    <!-- Sidebar -->
    <aside class="bg-gray-800 text-white w-64 flex flex-col justify-between h-screen">
        <div class="p-6">
            <h1 class="text-2xl font-bold mb-4">Admin Panel</h1>
            <p class="text-sm mb-6">Welcome, <?php echo htmlspecialchars($user_name); ?>!</p>
        </div>
        <nav class="flex-1">
            <ul class="space-y-4">
                <li>
                    <a href="admin_dashboard.php" class="flex items-center py-3 px-6 text-gray-300 hover:bg-gray-700 hover:text-white">
                        <i class="fas fa-tachometer-alt mr-3"></i> Dashboard
                    </a>
                </li>
                <li>
                    <a href="manage_orders.php" class="flex items-center py-3 px-6 text-gray-300 hover:bg-gray-700 hover:text-white">
                        <i class="fas fa-shopping-cart mr-3"></i> Manage Orders
                    </a>
                </li>
                <li>
                    <a href="manage_services.php" class="flex items-center py-3 px-6 text-gray-300 hover:bg-gray-700 hover:text-white">
                        <i class="fas fa-clipboard-list mr-3"></i> Manage Services
                    </a>
                </li>
                <li>
                    <a href="manage_categories.php" class="flex items-center py-3 px-6 text-gray-300 hover:bg-gray-700 hover:text-white">
                        <i class="fas fa-box mr-3"></i> Manage Categories
                    </a>
                </li>
                <li>
                    <a href="manage_users.php" class="flex items-center py-3 px-6 text-gray-300 hover:bg-gray-700 hover:text-white">
                        <i class="fas fa-users-cog mr-3"></i> Manage Users
                    </a>
                </li>
                <li>
                    <a href="manage_messages.php" class="flex items-center py-3 px-6 text-gray-300 hover:bg-gray-700 hover:text-white">
                        <i class="fas fa-envelope mr-3"></i> Manage Messages
                    </a>
                </li>
            </ul>
        </nav>
        <div class="p-6">
            <a href="../actions/logout_action.php" class="flex items-center py-3 px-6 text-red-400 hover:bg-red-600 hover:text-white">
                <i class="fas fa-sign-out-alt mr-3"></i> Logout
            </a>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col">
        <!-- Header -->
        <header class="bg-gray-700 text-white text-center py-6">
            <h1 class="text-4xl font-bold">Manage Orders</h1>
            <p class="text-lg mt-2">View and manage customer orders.</p>
        </header>

        <!-- Orders Content -->
        <main class="container mx-auto py-8 px-6 flex-1">
            <div class="bg-white shadow-md rounded-lg p-6 mb-6">
                <h2 class="text-xl font-semibold mb-4">Orders</h2>
                <table class="w-full table-auto border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-100 text-left">
                            <th class="border px-4 py-2">Order ID</th>
                            <th class="border px-4 py-2">Customer Name</th>
                            <th class="border px-4 py-2">Status</th>
                            <th class="border px-4 py-2">Receive by Date</th>
                            <th class="border px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($orders): ?>
                            <?php foreach ($orders as $order): ?>
                                <tr>
                                    <td class="border px-4 py-2"><?php echo htmlspecialchars($order['order_id']); ?></td>
                                    <td class="border px-4 py-2"><?php echo htmlspecialchars($order['name']); ?></td>
                                    <td class="border px-4 py-2"><?php echo htmlspecialchars($order['order_status']); ?></td>
                                    <td class="border px-4 py-2"><?php echo htmlspecialchars($order['receive_by_date']); ?></td>
                                    <td class="border px-4 py-2">
                                        <button class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition view-details-btn"
                                            data-order='<?php echo json_encode($order); ?>'>View Details</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="border px-4 py-2 text-center">No orders available</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-blue-800 text-white py-6">
            <div class="container mx-auto px-6 text-center">
                <p>&copy; <?php echo date("Y"); ?> Custom Quills. All rights reserved.</p>
            </div>
        </footer>
    </div>

    <!-- Modal Overlay -->
    <div class="fixed inset-0 bg-black bg-opacity-50 hidden" id="modalOverlay"></div>

    <!-- Modal -->
    <div class="fixed inset-0 flex items-center justify-center hidden" id="orderModal">
        <div class="bg-white w-full max-w-md mx-auto rounded-lg shadow-lg p-6">
            <h3 class="text-xl font-semibold mb-4">Order Details</h3>
            <div id="modalContent">
                <!-- Dynamic content will be inserted here -->
            </div>
            <button id="closeModal" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 mt-4">Close</button>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add event listener to all "View Details" buttons
            document.querySelectorAll('.view-details-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const order = JSON.parse(this.dataset.order); // Get the order data from the button's data-order attribute
                    const orderId = order.order_id; // Extract the order_id

                    // Fetch order details via AJAX
                    fetch('../actions/fetch_order_details_action.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({
                                order_id: orderId
                            }) // Send only the order_id
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.status === 'success') {
                                const orderDetails = data.data;

                                // Populate modal with fetched order details
                                const detailsHTML = orderDetails.map(detail => `
                        <p><strong>Service:</strong> ${detail.service_name}</p>
                        <p><strong>Price:</strong> GHS ${detail.service_price}</p>
                        <p><strong>Writer:</strong> ${detail.writer_name}</p>
                        <p><strong>Quantity:</strong> ${detail.qty}</p>
                    `).join('');
                                document.getElementById('modalContent').innerHTML = detailsHTML;

                                // Show modal and overlay
                                document.getElementById('modalOverlay').classList.remove('hidden');
                                document.getElementById('orderModal').classList.remove('hidden');
                            } else {
                                alert(data.message);
                            }
                        })
                        .catch(error => {
                            console.error('Error fetching order details:', error);
                        });
                });
            });

            // Close modal when clicking on close button
            document.getElementById('closeModal').addEventListener('click', () => {
                document.getElementById('modalOverlay').classList.add('hidden');
                document.getElementById('orderModal').classList.add('hidden');
            });

            // Close modal when clicking on the overlay
            document.getElementById('modalOverlay').addEventListener('click', () => {
                document.getElementById('modalOverlay').classList.add('hidden');
                document.getElementById('orderModal').classList.add('hidden');
            });
        });
    </script>

</body>

</html>