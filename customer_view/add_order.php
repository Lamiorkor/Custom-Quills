<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require_once("../controllers/writer_controller.php");
require_once("../controllers/service_controller.php");

$writers = getWritersController();

// Retrieve the service ID from the URL
$service_id = isset($_GET['serviceID']) ? intval($_GET['serviceID']) : null;

if ($service_id) {
    // Fetch the service details
    $service = getOneServiceController($service_id);
    if (!$service) {
        echo "Service not found.";
        exit();
    }
} else {
    echo "No service selected.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Place Your Order - Custom Quills</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex flex-col min-h-screen bg-gray-100">
    <!-- Header -->
    <header class="bg-blue-500 text-white p-6 text-center">
        <h1 class="text-3xl font-bold">Custom Quills</h1>
        <h2 class="italic text-xl mt-2">Place Your Order</h2>
    </header>

    <!-- Main Content -->
    <main class="max-w-3xl mx-auto py-10 px-6 bg-white shadow-md rounded-lg">
        <form action="../actions/add_order_action.php" method="POST">
            <!-- Select Service -->
            <div class="mb-6">
                <label for="service" class="block text-lg font-medium text-gray-700 mb-2">Service:</label>
                <input type="text" id="service" name="service_name" value="<?php echo htmlspecialchars($service['service_name']); ?>"
                    class="w-full border-gray-300 rounded-lg p-2" readonly>
                <input type="hidden" name="service_id" value="<?php echo htmlspecialchars($service['service_id']); ?>">
            </div>

            <!-- Select Writer -->
            <div class="mb-6">
                <label for="writer" class="block text-lg font-medium text-gray-700 mb-2">Select Writer:</label>
                <select id="writer" name="writer_id" class="w-full border-gray-300 rounded-lg p-2" required>
                    <option value="">-- Select a Writer --</option>
                    <?php foreach ($writers as $writer):
                        if ($writer['availability_status'] === 'available') { ?>
                            <option value="<?php echo htmlspecialchars($writer['writer_id']); ?>">
                                <?php echo htmlspecialchars($writer['name']) . " (Experience: " . htmlspecialchars($writer['years_of_experience']) . " years;
                                    Speciality: " . htmlspecialchars($writer['speciality']) . ")"; ?>
                            </option>
                    <?php }
                    endforeach; ?>
                </select>
            </div>

            <!-- Receive By Date -->
            <div class="mb-6">
                <label for="receive_by" class="block text-lg font-medium text-gray-700 mb-2">Receive By Date:</label>
                <input type="date" id="receive_by" name="receive_by_date" class="w-full border-gray-300 rounded-lg p-2" required>
            </div>

            <!-- Express Delivery -->
            <div class="mb-6">
                <label class="block text-lg font-medium text-gray-700 mb-2">Express Delivery:</label>
                <label class="inline-flex items-center">
                    <!-- Hidden input to ensure a value of 0 is sent when unchecked -->
                    <input type="hidden" name="express_delivery" value="0">
                    <input type="checkbox" name="express_delivery" value="1" class="form-checkbox border-gray-300">
                    <span class="ml-2">Deliver within 3 days (Additional Charge Applies)</span>
                </label>
            </div>

            <!-- Additional Instructions -->
            <div class="mb-6">
                <label for="instructions" class="block text-lg font-medium text-gray-700 mb-2">Additional Instructions:</label>
                <textarea id="instructions" name="instructions" rows="5" class="w-full border-gray-300 rounded-lg p-2" placeholder="Describe what you'd like your poem to be about..."></textarea>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600">
                Place Order
            </button>
        </form>
    </main>

    <!-- Footer -->
    <footer class="bg-blue-500 text-white py-6">
        <div class="container mx-auto text-center">
            <p>&copy; <?php echo date("Y"); ?> Custom Quills. All rights reserved.</p>
        </div>
    </footer>
</body>

</html>