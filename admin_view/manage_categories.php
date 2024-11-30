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

// Include categories controller
require('../controllers/categories_controller.php');
$categories = getCategoriesController();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Categories - Custom Quills</title>
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
            <h1 class="text-4xl font-bold">Manage Categories</h1>
            <p class="text-lg mt-2">Add, edit, or delete service categories.</p>
        </header>

        <!-- Content -->
        <main class="container mx-auto py-8 px-6">
            <!-- Add New Category -->
            <div class="bg-white shadow-md rounded-lg p-6 mb-6">
                <h2 class="text-xl font-semibold mb-4">Add New Category</h2>
                <form action="../actions/add_category_action.php" method="POST" class="flex space-x-4">
                    <input type="text" id="catName" name="catName" placeholder="Enter category name" 
                           class="border border-gray-300 rounded w-full p-2 focus:ring focus:ring-blue-300" required>
                    <button type="submit" name="action" value="add" 
                            class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 transition">
                        Add Category
                    </button>
                </form>
            </div>

            <!-- Existing Categories -->
            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-xl font-semibold mb-4">Existing Categories</h2>
                <table class="w-full table-auto border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-100 text-left">
                            <th class="border px-4 py-2">Category Name</th>
                            <th class="border px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($categories) { ?>
                            <?php foreach ($categories as $category) { ?>
                                <tr>
                                    <td class="border px-4 py-2"><?php echo htmlspecialchars($category['cat_name']); ?></td>
                                    <td class="border px-4 py-2">
                                        <form action="../actions/delete_category_action.php" method="POST">
                                            <input type="hidden" name="catID" value="<?php echo $category['cat_id']; ?>">
                                            <button type="submit" name="action" value="delete" 
                                                    class="bg-red-500 text-white py-1 px-3 rounded hover:bg-red-600 transition">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php } ?>
                        <?php } else { ?>
                            <tr>
                                <td colspan="2" class="border px-4 py-2 text-center">No categories available</td>
                            </tr>
                        <?php } ?>
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
</body>

</html>
