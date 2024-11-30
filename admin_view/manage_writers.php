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

// Include writer controller
require('../controllers/writer_controller.php');
$writers = getWritersController();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Writers - Custom Quills</title>
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
            <h1 class="text-4xl font-bold">Manage Writers</h1>
            <p class="text-lg mt-2">View and manage writers' details.</p>
        </header>

        <!-- Writers Content -->
        <main class="container mx-auto py-8 px-6 flex-1">
            <div class="overflow-x-auto bg-white shadow-md rounded-lg p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Existing Writers</h2>
                <table class="table-auto w-full border-collapse">
                    <thead>
                        <tr class="bg-gray-200 text-gray-600 uppercase text-sm">
                            <th class="px-6 py-3 border">Writer Name</th>
                            <th class="px-6 py-3 border">Experience</th>
                            <th class="px-6 py-3 border">Specialty</th>
                            <th class="px-6 py-3 border">Rating</th>
                            <th class="px-6 py-3 border">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($writers as $writer): ?>
                            <tr class="hover:bg-gray-100">
                                <td class="px-6 py-3 border"><?php echo htmlspecialchars($writer['writer_name']); ?></td>
                                <td class="px-6 py-3 border"><?php echo htmlspecialchars($writer['years_of_experience']); ?></td>
                                <td class="px-6 py-3 border"><?php echo htmlspecialchars($writer['speciality']); ?></td>
                                <td class="px-6 py-3 border"><?php echo htmlspecialchars($writer['rating']); ?></td>
                                <td class="px-6 py-3 border text-center">
                                    <form action="edit_writer.php" method="GET" class="inline-block">
                                        <input type="hidden" name="writerID" value="<?php echo $writer['writer_id']; ?>">
                                        <button type="submit" class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600 transition">Edit</button>
                                    </form>
                                    <form action="../actions/delete_writer_action.php" method="POST" class="inline-block">
                                        <input type="hidden" name="writerID" value="<?php echo $writer['writer_id']; ?>">
                                        <button type="submit" name="action" value="delete" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 transition">Delete</button>
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
