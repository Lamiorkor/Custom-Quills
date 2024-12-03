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
} elseif ($role === 'writer') {
    header("Location:../writer_view/writer_dashboard.php");
    exit();
}

// Include user controller
require_once ('../controllers/user_controller.php');
$userID = isset($_GET['userID']) ? $_GET['userID'] : null;

if (!$userID) {
    echo "No user ID provided.";
    exit();
}

$user = getOneUserDetailsController($userID);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User - Custom Quills</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen">
    <div class="max-w-4xl mx-auto mt-10 p-6 bg-white shadow-md rounded-lg">
        <h1 class="text-2xl font-bold mb-6">Edit User</h1>
        <form method="POST" action="../actions/edit_user_action.php">
            <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user['user_id']); ?>">

            <div class="mb-4">
                <label for="user_name" class="block text-gray-700 font-medium mb-2">User Name (Read Only):</label>
                <input type="text" name="user_name" id="user_name" value="<?php echo htmlspecialchars($user['name']); ?>" class="w-full border border-gray-300 rounded-lg p-2" readonly>
            </div>

            <div class="mb-4">
                <label for="user_email" class="block text-gray-700 font-medium mb-2">Email (Read Only):</label>
                <input type="email" name="user_email" id="user_email" value="<?php echo htmlspecialchars($user['email']); ?>" class="w-full border border-gray-300 rounded-lg p-2" readonly>
            </div>

            <div class="mb-4">
                <label for="user_role" class="block text-gray-700 font-medium mb-2">Role:</label>
                <select name="user_role" id="user_role" class="w-full border border-gray-300 rounded-lg p-2">
                    <option value="customer" <?php echo ($user['role'] === 'customer') ? 'selected' : ''; ?>>Customer</option>
                    <option value="writer" <?php echo ($user['role'] === 'writer') ? 'selected' : ''; ?>>Writer</option>
                    <option value="administrator" <?php echo ($user['role'] === 'administrator') ? 'selected' : ''; ?>>Administrator</option>
                </select>
            </div>

            <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition">Update User</button>
            <a href="manage_users.php" class="ml-4 text-blue-500 hover:underline">Back to Users</a>
        </form>
    </div>
</body>

</html>
