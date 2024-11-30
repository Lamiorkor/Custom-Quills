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

// Include user controller
require('../controllers/user_controller.php');
$users = getAllUsersController();
$pendingUsers = getPendingRoleRequestsController();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users - Custom Quills</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
            <h1 class="text-4xl font-bold">Manage Users</h1>
            <p class="text-lg mt-2">View and manage users' roles on the platform.</p>
        </header>

        <!-- Main Content -->
        <main class="container mx-auto py-8 px-6 flex-1">
            <!-- Users Table -->
            <div class="bg-white shadow-md rounded-lg p-6 mb-6">
                <h2 class="text-xl font-semibold mb-4">Existing Users</h2>
                <table class="w-full table-auto border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-100 text-left">
                            <th class="px-4 py-2 border">User Name</th>
                            <th class="px-4 py-2 border">Email</th>
                            <th class="px-4 py-2 border">Role</th>
                            <th class="px-4 py-2 border">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user): ?>
                            <tr class="hover:bg-gray-100">
                                <td class="px-4 py-2 border"><?php echo htmlspecialchars($user['name']); ?></td>
                                <td class="px-4 py-2 border"><?php echo htmlspecialchars($user['email']); ?></td>
                                <td class="px-4 py-2 border"><?php echo htmlspecialchars($user['role']); ?></td>
                                <td class="px-4 py-2 border text-center">
                                    <form action="edit_user.php" method="GET" class="inline-block">
                                        <input type="hidden" name="userID" value="<?php echo $user['user_id']; ?>">
                                        <button type="submit" class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600 transition">Edit</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- Pending Users Table -->
            <div class="bg-white shadow-md rounded-lg p-6 mb-6">
                <h2 class="text-xl font-semibold mb-4">Pending Role Requests</h2>
                <table class="w-full table-auto border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-100 text-left">
                            <th class="px-4 py-2 border">User Name</th>
                            <th class="px-4 py-2 border">Requested Role</th>
                            <th class="px-4 py-2 border">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pendingUsers as $pendingUser): ?>
                            <tr class="hover:bg-gray-100">
                                <td class="px-4 py-2 border"><?php echo htmlspecialchars($pendingUser['name']); ?></td>
                                <td class="px-4 py-2 border"><?php echo htmlspecialchars($pendingUser['requested_role']); ?></td>
                                <td class="px-4 py-2 border text-center">
                                    <form action="../actions/assign_role_action.php" method="POST" class="inline-block">
                                        <input type="hidden" name="userID" value="<?php echo $pendingUser['user_id']; ?>">
                                        <select name="role" class="border border-gray-300 rounded w-full p-2">
                                            <option value="writer">Writer</option>
                                            <option value="customer">Customer</option>
                                        </select>
                                        <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded mt-2">Assign Role</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
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
