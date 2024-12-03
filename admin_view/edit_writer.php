<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$writerID = $_GET['writerID'];

if (!$writerID) {
    echo "No writer ID provided.";
    exit;
}

include('../controllers/writer_controller.php');
$writer = getOneWriterController($writerID);

if (!$writer) {
    echo "Writer not found.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Writer - Custom Quills</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen">
    <div class="max-w-4xl mx-auto mt-10 p-6 bg-white shadow-md rounded-lg">
        <h1 class="text-2xl font-bold mb-6">Edit Writer</h1>
        <form id="editWriterForm" method="POST" action="../actions/edit_writer_action.php">
            <input type="hidden" name="writer_id" value="<?php echo htmlspecialchars($writer['writer_id']); ?>">

            <div class="mb-4">
                <label for="writer_name" class="block text-gray-700 font-medium mb-2">Writer Name (Read Only):</label>
                <input type="text" name="writer_name" id="writer_name" value="<?php echo htmlspecialchars($writer['name']); ?>" class="w-full border border-gray-300 rounded-lg p-2" readonly>
            </div>

            <div class="mb-4">
                <label for="years_of_experience" class="block text-gray-700 font-medium mb-2">Years of Experience:</label>
                <input type="number" name="years_of_experience" id="years_of_experience" value="<?php echo htmlspecialchars($writer['years_of_experience']); ?>" class="w-full border border-gray-300 rounded-lg p-2" required>
            </div>

            <div class="mb-4">
                <label for="speciality" class="block text-gray-700 font-medium mb-2">Speciality:</label>
                <input type="text" name="speciality" id="speciality" value="<?php echo htmlspecialchars($writer['speciality']); ?>" class="w-full border border-gray-300 rounded-lg p-2" required>
            </div>

            <div class="mb-4">
                <label for="rating" class="block text-gray-700 font-medium mb-2">Rating (out of 5):</label>
                <input type="number" name="rating" id="rating" value="<?php echo htmlspecialchars($writer['rating']); ?>" class="w-full border border-gray-300 rounded-lg p-2" min="1" max="5" step="0.1" required>
            </div>

            <div class="mb-4">
                <label for="availability" class="block text-gray-700 font-medium mb-2">Availability:</label>
                <select name="availability" id="availability" class="w-full border border-gray-300 rounded-lg p-2" required>
                    <option value="available" <?php echo ($writer['availability_status'] === 'available') ? 'selected' : ''; ?>>Available</option>
                    <option value="unavailable" <?php echo ($writer['availability_status'] === 'unavailable') ? 'selected' : ''; ?>>Unavailable</option>
                </select>
            </div>

            <button type="submit" name="action" value="update" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition">Update Writer</button>
            <a href="manage_writers.php" class="ml-4 text-blue-500 hover:underline">Back to Writers</a>
        </form>
    </div>
</body>

</html>
