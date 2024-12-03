<?php
// Include the necessary controllers
include('../controllers/categories_controller.php');

// Fetch categories for the dropdown
$categories = getCategoriesController();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Service</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex bg-gray-100 font-sans leading-normal tracking-normal min-h-screen">
    <!-- Sidebar -->
    <aside class="bg-gray-800 text-white w-64 flex flex-col justify-between h-screen">
        <div class="p-6">
            <h1 class="text-2xl font-bold mb-4">Admin Panel</h1>
            <p class="text-sm mb-6">Welcome, Admin!</p>
        </div>
        <nav class="flex-1">
            <ul class="space-y-4">
                <li><a href="admin_dashboard.php" class="flex items-center py-3 px-6 text-gray-300 hover:bg-gray-700 hover:text-white">Dashboard</a></li>
                <li><a href="services.php" class="flex items-center py-3 px-6 text-gray-300 hover:bg-gray-700 hover:text-white">Manage Services</a></li>
            </ul>
        </nav>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 p-8">
        <h1 class="text-2xl font-bold mb-4">Add New Service</h1>
        <form id="addServiceForm" method="POST" action="../actions/add_service_action.php" class="bg-white p-6 rounded-lg shadow-md">
            <div class="mb-4">
                <label for="serviceName" class="block text-gray-700 font-bold mb-2">Service Name:</label>
                <input type="text" id="serviceName" name="serviceName" class="w-full border border-gray-300 rounded-lg p-2" required>
            </div>

            <div class="mb-4">
                <label for="serviceCategory" class="block text-gray-700 font-bold mb-2">Service Category:</label>
                <select id="serviceCategory" name="serviceCategory" class="w-full border border-gray-300 rounded-lg p-2" required>
                    <option value="">Select Category</option>
                    <?php
                    // Populate the dropdown with categories
                    if ($categories !== null) {
                        foreach ($categories as $category) {
                            echo "<option value='{$category['cat_id']}'>{$category['cat_name']}</option>";
                        }
                    } else {
                        echo "<option value=''>No categories available</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="mb-4">
                <label for="servicePrice" class="block text-gray-700 font-bold mb-2">Price:</label>
                <input type="number" id="servicePrice" name="servicePrice" class="w-full border border-gray-300 rounded-lg p-2" required step="0.01">
            </div>

            <div class="mb-4">
                <label for="serviceDesc" class="block text-gray-700 font-bold mb-2">Description:</label>
                <textarea id="serviceDesc" name="serviceDesc" class="w-full border border-gray-300 rounded-lg p-2" required></textarea>
            </div>

            <div class="mb-4">
                <label for="serviceKeywords" class="block text-gray-700 font-bold mb-2">Keywords:</label>
                <input type="text" id="serviceKeywords" name="serviceKeywords" class="w-full border border-gray-300 rounded-lg p-2" required>
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Add Service</button>
        </form>
        <div class="mt-4">
            <a href="services.php" class="text-blue-500 hover:underline">Back to Services</a>
        </div>
    </div>
</body>

</html>
