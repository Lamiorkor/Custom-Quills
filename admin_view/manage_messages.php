<?php
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

// Include messages controller
require('../controllers/messages_controller.php');
$messages = getMessagesController();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Messages - Custom Quills</title>
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
            <h1 class="text-4xl font-bold">Manage Messages</h1>
            <p class="text-lg mt-2">View and respond to customer messages.</p>
        </header>

        <!-- Messages Content -->
        <main class="container mx-auto py-8 px-6 flex-1">
            <div class="bg-white shadow-md rounded-lg p-6 mb-6">
                <h2 class="text-xl font-semibold mb-4">Messages</h2>
                <?php if ($messages): ?>
                    <?php foreach ($messages as $message): ?>
                        <div class="border-b border-gray-200 py-4">
                            <p class="font-semibold"><?php echo htmlspecialchars($message['name']); ?> (<?php echo htmlspecialchars($message['email']); ?>)</p>
                            <p class="text-sm text-gray-600"><?php echo nl2br(htmlspecialchars($message['message'])); ?></p>
                            <form action="../actions/reply_message_action.php" method="POST" class="mt-4">
                                <input type="hidden" name="message_id" value="<?php echo $message['id']; ?>">
                                <textarea name="reply" rows="4" placeholder="Reply to this message" class="border border-gray-300 rounded w-full p-2 mt-2" required></textarea>
                                <button type="submit" name="action" value="reply" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 mt-2">
                                    Send Reply
                                </button>
                            </form>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No messages available.</p>
                <?php endif; ?>
            </div>
        </main>

        <!-- Footer Section -->
        <footer class="bg-blue-800 text-white py-6">
            <div class="container mx-auto px-6 text-center">
                <p>&copy; <?php echo date("Y"); ?> Custom Quills. All rights reserved.</p>
            </div>
        </footer>
    </div>
</body>

</html>
