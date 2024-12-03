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
} elseif ($role === 'administrator') {
    header("Location:../admin_view/admin_dashboard.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Writer Dashboard - Custom Quills</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body class="flex bg-gray-100 font-sans leading-normal tracking-normal min-h-screen">

    <!-- Sidebar Navigation -->
    <aside class="bg-gray-800 text-white w-64 flex flex-col justify-between h-screen">
        <!-- Sidebar Header -->
        <div class="p-6">
            <h1 class="text-2xl font-bold mb-4">Writer Dashboard</h1>
            <p class="text-sm mb-6">Welcome, <?php echo htmlspecialchars($user_name); ?>!</p>
        </div>

        <!-- Sidebar Navigation Links -->
        <nav class="flex-1">
            <ul class="space-y-4">
                <li>
                    <a href="writer_dashboard.php" class="flex items-center py-3 px-6 text-gray-300 hover:bg-gray-700 hover:text-white">
                        <i class="fas fa-tachometer-alt mr-3"></i> Dashboard
                    </a>
                </li>

                <li>
                    <a href="writer_order_requests.php" class="flex items-center py-3 px-6 text-gray-300 hover:bg-gray-700 hover:text-white">
                        <i class="fas fa-shopping-cart mr-3"></i> Order Requests
                    </a>
                </li>

                <li>
                    <a href="writer_messages.php" class="flex items-center py-3 px-6 text-gray-300 hover:bg-gray-700 hover:text-white">
                        <i class="fas fa-envelope mr-3"></i> Messages
                    </a>
                </li>

                <li>
                    <a href="writer_user_profile.php" class="flex items-center py-3 px-6 text-gray-300 hover:bg-gray-700 hover:text-white">
                        <i class="fas fa-user-circle mr-3"></i> Profile
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Sidebar Footer -->
        <div class="p-6">
            <a href="../actions/logout_action.php" class="flex items-center py-3 px-6 text-red-400 hover:bg-red-600 hover:text-white">
                <i class="fas fa-sign-out-alt mr-3"></i> Logout
            </a>
        </div>
    </aside>

    <!-- Main Content Area -->
    <div class="flex-1 flex flex-col">
        <!-- Header -->
        <header class="bg-blue-800 text-white text-center py-6">
            <h1 class="text-4xl font-bold">Writer Dashboard</h1>
            <p class="text-lg mt-2">Manage your orders, messages, and profile.</p>
        </header>

        <!-- Main Dashboard Content -->
        <main class="container mx-auto py-8 px-6 flex-1">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

                <!-- Order Requests Card -->
                <div class="bg-white shadow-md rounded-lg p-6 hover:shadow-lg transition">
                    <h2 class="text-xl font-semibold text-gray-800">Order Requests</h2>
                    <p class="text-gray-600 mt-2">View and manage your order requests.</p>
                    <a href="writer_order_requests.php" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">Go to Order Requests</a>
                </div>

                <!-- Messages Card -->
                <div class="bg-white shadow-md rounded-lg p-6 hover:shadow-lg transition">
                    <h2 class="text-xl font-semibold text-gray-800">Manage Messages</h2>
                    <p class="text-gray-600 mt-2">View and respond to customer messages.</p>
                    <a href="writer_messages.php" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">Go to Messages</a>
                </div>

                <!-- Profile Card -->
                <div class="bg-white shadow-md rounded-lg p-6 hover:shadow-lg transition">
                    <h2 class="text-xl font-semibold text-gray-800">Profile</h2>
                    <p class="text-gray-600 mt-2">Update your profile information.</p>
                    <a href="writer_user_profile.php" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">Go to Profile</a>
                </div>

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
