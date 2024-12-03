<?php
session_start();
require_once('../controllers/writer_controller.php');
require_once('../controllers/order_controller.php');

// Ensure the writer is logged in
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'writer') {
    header("Location: ../view/login.php");
    exit();
}

// Fetch orders assigned to the writer
$orders = getWriterRequestsController($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Requests - Custom Quills</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body class="flex bg-gray-100 font-sans leading-normal tracking-normal min-h-screen">

    <!-- Sidebar Navigation -->
    <aside class="bg-gray-800 text-white w-64 flex flex-col justify-between h-screen">
        <div class="p-6">
            <h1 class="text-2xl font-bold mb-4">Writer Dashboard</h1>
            <p class="text-sm mb-6">Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</p>
        </div>
        <nav class="flex-1">
            <ul class="space-y-4">
                <li><a href="writer_dashboard.php" class="flex items-center py-3 px-6 text-gray-300 hover:bg-gray-700 hover:text-white"><i class="fas fa-tachometer-alt mr-3"></i> Dashboard</a></li>
                <li><a href="writer_order_requests.php" class="flex items-center py-3 px-6 text-gray-300 hover:bg-gray-700 hover:text-white"><i class="fas fa-shopping-cart mr-3"></i> Order Requests</a></li>
                <li><a href="writer_messages.php" class="flex items-center py-3 px-6 text-gray-300 hover:bg-gray-700 hover:text-white"><i class="fas fa-envelope mr-3"></i> Messages</a></li>
                <li><a href="writer_user_profile.php" class="flex items-center py-3 px-6 text-gray-300 hover:bg-gray-700 hover:text-white"><i class="fas fa-user-circle mr-3"></i> Profile</a></li>
            </ul>
        </nav>
        <div class="p-6">
            <a href="../actions/logout_action.php" class="flex items-center py-3 px-6 text-red-400 hover:bg-red-600 hover:text-white">
                <i class="fas fa-sign-out-alt mr-3"></i> Logout
            </a>
        </div>
    </aside>

    <!-- Main Content Area -->
    <div class="flex-1 flex flex-col">
        <header class="bg-blue-800 text-white text-center py-6">
            <h1 class="text-4xl font-bold">Order Requests</h1>
            <p class="text-lg mt-2">Manage and accept your assigned orders.</p>
        </header>

        <!-- Order Requests Content -->
        <main class="container mx-auto py-8 px-6 flex-1">
            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-xl font-semibold mb-4">Your Order Requests</h2>
                <?php if ($orders): ?>
                    <ul class="space-y-6">
                        <?php foreach ($orders as $order): 
                            $orderID = $order['order_id'];
                            $order_details = getCustomerOrderDetailsController($orderID);
                            $customer_name = $order_details['name'] ?? 'Unknown'; ?>
                            <li class="border-b border-gray-200 pb-6">
                                <h3 class="text-lg font-semibold">Order #<?php echo htmlspecialchars($order['order_id']); ?></h3>
                                <p><strong>Service:</strong> <?php echo htmlspecialchars($order['service_name']); ?></p>
                                <p><strong>Customer:</strong> <?php echo htmlspecialchars($customer_name); ?></p>
                                <p><strong>Email:</strong> <?php echo htmlspecialchars($order_details['email']); ?></p>
                                <p><strong>Instructions:</strong> <?php echo nl2br(htmlspecialchars($order['instructions'])); ?></p>
                                <p><strong>Status:</strong> <span class="text-blue-600"><?php echo htmlspecialchars($order['order_status']); ?></span></p>

                                <div class="mt-4 flex space-x-4">
                                    <?php if ($order['order_status'] === 'pending'): ?>
                                        <a href="../actions/accept_order_action.php?order_id=<?php echo $order['order_id']; ?>" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition">
                                            Accept Order
                                        </a>
                                    <?php endif; ?>
                                    <a href="../actions/mark_order_completed_action.php?order_id=<?php echo $order['order_id']; ?>&customer_email=<?php echo $order_details['email']; ?>" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">
                                        Mark as Completed
                                    </a>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p class="text-center text-gray-500 mt-4">No order requests available.</p>
                <?php endif; ?>
            </div>
        </main>

        <footer class="bg-blue-800 text-white py-6">
            <div class="container mx-auto px-6 text-center">
                <p>&copy; <?php echo date("Y"); ?> Custom Quills. All rights reserved.</p>
            </div>
        </footer>
    </div>
</body>
</html>
