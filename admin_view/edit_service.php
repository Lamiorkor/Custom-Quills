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

$serviceID = isset($_GET['serviceID']) ? $_GET['serviceID'] : null;

if (!$serviceID) {
    echo "No service ID provided.";
    exit;
}

include ('../controllers/service_controller.php');
$service = getOneServiceController($serviceID);
//$allservices = getServicesController();

if (!$service) {
    echo "Service not found.";
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Service - Custom Quills</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen">
    <div class="max-w-4xl mx-auto mt-10 p-6 bg-white shadow-md rounded-lg">
        <h1 class="text-2xl font-bold mb-6">Edit Service</h1>
        <form id="editServiceForm" method="POST" action="../actions/edit_service_action.php">
            <input type="hidden" name="service_id" value="<?php echo htmlspecialchars($service['service_id']); ?>">

            <div class="mb-4">
                <label for="editServiceName" class="block text-gray-700 font-medium mb-2">Service Name:</label>
                <input type="text" name="service_name" id="editServiceName" value="<?php echo htmlspecialchars($service['service_name']); ?>" class="w-full border border-gray-300 rounded-lg p-2" required>
            </div>

            <div class="mb-4">
                <label for="editServiceCategory" class="block text-gray-700 font-medium mb-2">Service Category:</label>
                <select id="editServiceCategory" name="service_category" class="w-full border border-gray-300 rounded-lg p-2" required>
                    <option value="<?php echo htmlspecialchars($service['service_category']); ?>"><?php echo htmlspecialchars($service['cat_name']); ?></option>
                </select>
            </div>

            <div class="mb-4">
                <label for="editServicePrice" class="block text-gray-700 font-medium mb-2">Price:</label>
                <input type="number" name="service_price" id="editServicePrice" value="<?php echo htmlspecialchars($service['service_price']); ?>" class="w-full border border-gray-300 rounded-lg p-2" required>
            </div>

            <div class="mb-4">
                <label for="editServiceDesc" class="block text-gray-700 font-medium mb-2">Description:</label>
                <textarea name="service_desc" id="editServiceDesc" class="w-full border border-gray-300 rounded-lg p-2" required><?php echo htmlspecialchars($service['service_desc']); ?></textarea>
            </div>

            <div class="mb-4">
                <label for="editServiceKeywords" class="block text-gray-700 font-medium mb-2">Keywords:</label>
                <input type="text" name="service_keywords" id="editServiceKeywords" value="<?php echo htmlspecialchars($service['service_keywords']); ?>" class="w-full border border-gray-300 rounded-lg p-2" required>
            </div>

            <button type="submit" name="action" value="update" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition">Update Service</button>
            <a href="manage_services.php" class="ml-4 text-blue-500 hover:underline">Back to Services</a>
        </form>
    </div>
</body>

</html>
