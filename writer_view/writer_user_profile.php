<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include('../controllers/writer_controller.php');

// Ensure the writer is logged in
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'writer') {
    header("Location: ../view/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$writer = getOneWriterController($user_id);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Writer Profile - Custom Quills</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex flex-col min-h-screen bg-gray-100">

    <!-- Header Section -->
    <header class="bg-blue-500 text-white p-6 text-center">
        <h1 class="text-3xl font-bold">Custom Quills</h1>
        <h2 class="italic text-xl mt-2">Your Profile</h2>
    </header>

    <!-- Breadcrumb -->
    <nav class="bg-gray-200 py-3 px-6">
        <ol class="flex space-x-2 text-sm">
            <li><a href="writer_dashboard.php" class="text-blue-500 hover:text-blue-700">Dashboard</a></li>
            <li class="text-gray-500">/</li>
            <li class="text-gray-700">Edit Profile</li>
        </ol>
    </nav>

    <!-- Main Content Section -->
    <main class="max-w-3xl mx-auto py-10 px-6 bg-white shadow-md rounded-lg">
        <h2 class="text-2xl font-semibold text-center mb-6">Edit Your Profile</h2>

        <form method="POST" action="../actions/update_user_profile_action.php">
            <!-- Hidden input for User ID -->
            <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($writer['user_id']); ?>">

            <!-- User Name -->
            <label for="user_name" class="block text-gray-700 font-medium mb-2">Name:</label>
            <input type="text" name="user_name" id="user_name" value="<?php echo htmlspecialchars($writer['name']); ?>" class="w-full border border-gray-300 rounded-lg p-2" required>

            <!-- User Email -->
            <label for="user_email" class="block text-gray-700 font-medium mb-2">Email:</label>
            <input type="email" name="user_email" id="user_email" value="<?php echo htmlspecialchars($writer['email']); ?>" class="w-full border border-gray-300 rounded-lg p-2" required>

            <!-- User Password -->
            <label for="password" class="block text-gray-700 font-medium mb-2">Password:</label>
            <input type="password" name="password" id="password" class="w-full border border-gray-300 rounded-lg p-2" required>

            <!-- Years of Experience -->
            <label for="years_of_experience" class="block text-gray-700 font-medium mb-2">Years of Experience:</label>
            <input type="number" name="years_of_experience" id="years_of_experience" value="<?php echo htmlspecialchars($writer['years_of_experience']); ?>" class="w-full border border-gray-300 rounded-lg p-2" required>

            <!-- Speciality -->
            <label for="speciality" class="block text-gray-700 font-medium mb-2">Speciality:</label>
            <input type="text" name="speciality" id="speciality" value="<?php echo htmlspecialchars($writer['speciality']); ?>" class="w-full border border-gray-300 rounded-lg p-2" required>

            <!-- Availability -->
            <label for="availability" class="block text-gray-700 font-medium mb-2">Availability:</label>
            <select name="availability" id="availability" class="w-full border border-gray-300 rounded-lg p-2">
                <option value="available" <?php echo ($writer['availability_status'] === 'available') ? 'selected' : ''; ?>>Available</option>
                <option value="unavailable" <?php echo ($writer['availability_status'] === 'unavailable') ? 'selected' : ''; ?>>Unavailable</option>
            </select>

            <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition mt-4">Update Profile</button>
        </form>
    </main>

    <!-- Footer Section -->
    <footer class="bg-blue-500 text-white py-6">
        <div class="container mx-auto px-6 text-center">
            <p>&copy; <?php echo date("Y"); ?> Custom Quills. All rights reserved.</p>
        </div>
    </footer>
</body>

</html>
