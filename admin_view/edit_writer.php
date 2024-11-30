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
    <title>Edit Writer</title>
    <link rel="stylesheet" href="../css/writers.css">
</head>
<body>
    <h1>Edit Writer</h1>

    <form id="editWriterForm" method="POST" action="../actions/edit_writer_action.php">
        <!-- Hidden input to store writer ID -->
        <input type="hidden" name="writer_id" value="<?php echo htmlspecialchars($writer['writer_id']); ?>">

        <!-- Writer Name -->
        <label for="writer_name">Writer Name:</label>
        <input type="text" name="writer_name" id="writer_name" value="<?php echo htmlspecialchars($writer['writer_name']); ?>" required>

        <!-- Years of Experience -->
        <label for="years_of_experience">Years of Experience:</label>
        <input type="number" name="years_of_experience" id="years_of_experience" value="<?php echo htmlspecialchars($writer['years_of_experience']); ?>" required>

        <!-- Speciality -->
        <label for="speciality">Speciality:</label>
        <input type="text" name="speciality" id="speciality" value="<?php echo htmlspecialchars($writer['speciality']); ?>" required>

        <!-- Rating -->
        <label for="rating">Rating (out of 5):</label>
        <input type="number" name="rating" id="rating" value="<?php echo htmlspecialchars($writer['rating']); ?>" required min="1" max="5" step="0.1">

        <!-- Availability Status -->
        <label for="availability">Availability:</label>
        <select name="availability" id="availability" required>
            <option value="available" <?php echo ($writer['availability_status'] === 'available') ? 'selected' : ''; ?>>Available</option>
            <option value="unavailable" <?php echo ($writer['availability_status'] === 'unavailable') ? 'selected' : ''; ?>>Unavailable</option>
        </select>

        <!-- Submit button -->
        <button type="submit" name="action" value="update">Update Writer</button>
    </form>

    <a href="writers.php">Back to Writers</a> <!-- Link to go back to the writers page -->
</body>
</html>
