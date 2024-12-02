<?php
session_start();
require_once('../controllers/user_controller.php');
$users = getAllUsersController(); // Fetch all users to populate the dropdown
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Writer</title>
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
                <li><a href="manage_writers.php" class="flex items-center py-3 px-6 text-gray-300 hover:bg-gray-700 hover:text-white">Manage Writers</a></li>
            </ul>
        </nav>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 p-8">
        <h1 class="text-2xl font-bold mb-4">Add Writer</h1>
        <form method="POST" action="../actions/add_writer_action.php" class="bg-white p-6 rounded-lg shadow-md">
            <div class="mb-4">
                <label for="user_id" class="block text-gray-700 font-bold mb-2">Select User:</label>
                <select name="user_id" id="user_id" class="w-full border border-gray-300 rounded-lg p-2" required>
                    <option value="">-- Select User --</option>
                    <?php foreach ($users as $user): ?>
                        <option value="<?php echo $user['user_id']; ?>"><?php echo $user['name']; ?></option>
                    <?php endforeach; ?>
                </select>
                <p class="text-gray-500 text-sm mt-2">User must be registered on the platform.</p>
            </div>

            <div class="mb-4">
                <label for="years_of_experience" class="block text-gray-700 font-bold mb-2">Years of Experience:</label>
                <input type="number" name="years_of_experience" id="years_of_experience" class="w-full border border-gray-300 rounded-lg p-2" required>
            </div>

            <div class="mb-4">
                <label for="speciality" class="block text-gray-700 font-bold mb-2">Speciality:</label>
                <input type="text" name="speciality" id="speciality" class="w-full border border-gray-300 rounded-lg p-2" placeholder="E.g., Love Poems, Satire" required>
            </div>

            <div class="mb-4">
                <label for="rating" class="block text-gray-700 font-bold mb-2">Rating (Out of 5):</label>
                <input type="number" name="rating" id="rating" class="w-full border border-gray-300 rounded-lg p-2" min="1" max="5" step="0.1" required>
            </div>

            <div class="mb-4">
                <label for="availability" class="block text-gray-700 font-bold mb-2">Availability:</label>
                <select name="availability" id="availability" class="w-full border border-gray-300 rounded-lg p-2" required>
                    <option value="available">Available</option>
                    <option value="unavailable">Unavailable</option>
                </select>
            </div>

            <button type="submit" name="action" value="add" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Add Writer</button>
        </form>
    </div>
</body>

</html>
