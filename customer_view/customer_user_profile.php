<?php
session_start();
include('../controllers/user_controller.php');
include('../controllers/customer_controller.php');

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../view/login.php");
    exit();
}

// Get user details
$user_id = $_SESSION['user_id'];
$user = getOneUserDetailsController($user_id);

if (!$user) {
    echo "User not found.";
    exit();
}

$customer = getCustomerDetailsController($user_id); // Fetch additional customer data
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile - Custom Quills</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex flex-col min-h-screen bg-gray-100">
    <!-- Header Section -->
    <header class="bg-blue-500 text-white p-6 text-center">
        <h1 class="text-3xl font-bold">Custom Quills</h1>
        <h2 class="italic text-xl mt-2">Your Profile</h2>
    </header>

    <!-- Breadcrumb -->
    <nav class="bg-gray-100 py-3 px-6">
        <a href="javascript:history.back()" class="text-blue-500 hover:underline text-sm">
            &larr; Go Back
        </a>
    </nav>

    <!-- Main Content Section -->
    <main class="max-w-3xl mx-auto py-10 px-6 bg-white shadow-md rounded-lg">
        <h2 class="text-2xl font-semibold text-center mb-6">Edit Your Profile</h2>

        <form method="POST" action="../actions/edit_user_action.php">
            <!-- Hidden input for User ID -->
            <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user['user_id']); ?>">

            <!-- User Name -->
            <label for="user_name" class="block text-gray-700 font-medium mb-2">Name:</label>
            <input type="text" name="user_name" id="user_name" value="<?php echo htmlspecialchars($user['name']); ?>" class="w-full border border-gray-300 rounded-lg p-2" required>

            <!-- User Email -->
            <label for="user_email" class="block text-gray-700 font-medium mb-2">Email:</label>
            <input type="email" name="user_email" id="user_email" value="<?php echo htmlspecialchars($user['email']); ?>" class="w-full border border-gray-300 rounded-lg p-2" required>

            <!-- User Password -->
            <label for="password" class="block text-gray-700 font-medium mb-2">Password:</label>
            <input type="password" name="password" id="password" class="w-full border border-gray-300 rounded-lg p-2" required>

            <!-- User Role (Request Role Change) -->
            <label for="user_role" class="block text-gray-700 font-medium mb-2">Role (Request Role Change):</label>
            <select name="user_role" id="user_role" class="w-full border border-gray-300 rounded-lg p-2">
                <option value="customer" <?php echo ($user['role'] === 'customer') ? 'selected' : ''; ?>>Customer</option>
                <option value="writer" <?php echo ($user['role'] === 'writer') ? 'selected' : ''; ?>>Writer</option>
                <option value="administrator" <?php echo ($user['role'] === 'administrator') ? 'selected' : ''; ?>>Administrator</option>
            </select>

            <!-- Customer Additional Fields -->
            <label for="country" class="block text-gray-700 font-medium mb-2">Country:</label>
            <input type="text" name="country" id="country" value="<?php echo htmlspecialchars($customer['country']); ?>" class="w-full border border-gray-300 rounded-lg p-2" required>

            <label for="city" class="block text-gray-700 font-medium mb-2">City:</label>
            <input type="text" name="city" id="city" value="<?php echo htmlspecialchars($customer['city']); ?>" class="w-full border border-gray-300 rounded-lg p-2" required>

            <label for="phone_number" class="block text-gray-700 font-medium mb-2">Phone Number:</label>
            <input type="text" name="phone_number" id="phone_number" value="<?php echo htmlspecialchars($customer['phone_number']); ?>" class="w-full border border-gray-300 rounded-lg p-2" required>

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