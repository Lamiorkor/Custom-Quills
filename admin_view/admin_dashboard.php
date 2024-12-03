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

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Custom Quills</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body class="flex bg-gray-100 font-sans leading-normal tracking-normal min-h-screen">

    <!-- Sidebar Navigation -->
    <aside class="bg-gray-800 text-white w-64 flex flex-col justify-between h-screen">
        <!-- Sidebar Header -->
        <div class="p-6">
            <h1 class="text-2xl font-bold mb-4">Admin Panel</h1>
            <p class="text-sm mb-6">Welcome, <?php echo htmlspecialchars($user_name); ?>!</p>
        </div>

        <!-- Sidebar Navigation Links -->
        <nav class="flex-1">
            <ul class="space-y-4">
                <?php if ($role === 'administrator') { ?>
                    <li>
                        <a href="admin_dashboard.php" class="flex items-center py-3 px-6 text-gray-300 hover:bg-gray-700 hover:text-white">
                            <i class="fas fa-tachometer-alt mr-3"></i> Dashboard
                        </a>
                    </li>
                <?php } ?>

                <?php if ($role === 'administrator') { ?>
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
                <?php } ?>

                <li>
                    <a href="manage_messages.php" class="flex items-center py-3 px-6 text-gray-300 hover:bg-gray-700 hover:text-white">
                        <i class="fas fa-envelope mr-3"></i> Manage Messages
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
            <h1 class="text-4xl font-bold">Admin Dashboard</h1>
            <p class="text-lg mt-2">Manage your platform efficiently.</p>
        </header>

        <!-- User Profile Button -->
        <div class="fixed top-0 right-0 m-4">
            <?php if (isset($_SESSION['user_id'])) { ?>
                <a href="admin_user_profile.php">
                    <button class="bg-blue-500 text-white px-4 py-2 rounded-full shadow-md hover:bg-blue-700">View Profile</button>
                </a>
            <?php } ?>
        </div>

        <!-- Main Dashboard Content -->
        <main class="container mx-auto py-8 px-6 flex-1">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Users Card -->
                <div class="bg-white shadow-md rounded-lg p-6 hover:shadow-lg transition">
                    <h2 class="text-xl font-semibold text-gray-800">Manage Users</h2>
                    <p class="text-gray-600 mt-2">Add, edit, or delete users on the platform.</p>
                    <a href="manage_users.php" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">Go to Writers</a>
                </div>

                <!-- Services Card -->
                <div class="bg-white shadow-md rounded-lg p-6 hover:shadow-lg transition">
                    <h2 class="text-xl font-semibold text-gray-800">Manage Services</h2>
                    <p class="text-gray-600 mt-2">View and update poetry services.</p>
                    <a href="manage_services.php" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">Go to Services</a>
                </div>

                <!-- Categories Card -->
                <div class="bg-white shadow-md rounded-lg p-6 hover:shadow-lg transition">
                    <h2 class="text-xl font-semibold text-gray-800">Manage Categories</h2>
                    <p class="text-gray-600 mt-2">Add or update categories for services.</p>
                    <a href="manage_categories.php" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">Go to Categories</a>
                </div>

                <!-- Orders Card -->
                <div class="bg-white shadow-md rounded-lg p-6 hover:shadow-lg transition">
                    <h2 class="text-xl font-semibold text-gray-800">Manage Orders</h2>
                    <p class="text-gray-600 mt-2">View and update customer orders.</p>
                    <a href="manage_orders.php" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">Go to Orders</a>
                </div>

                <!-- Messages Card -->
                <div class="bg-white shadow-md rounded-lg p-6 hover:shadow-lg transition">
                    <h2 class="text-xl font-semibold text-gray-800">Manage Messages</h2>
                    <p class="text-gray-600 mt-2">View and respond to customer messages.</p>
                    <a href="manage_messages.php" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">Go to Orders</a>
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