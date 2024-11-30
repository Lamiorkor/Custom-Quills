<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("../controllers/writer_controller.php");

// Check if form has been submitted and if action is set to "update"
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update') {
    // Retrieve form data
    $writerID = $_POST['writer_id'];
    $writerName = $_POST['writer_name'];
    $yearsOfExperience = $_POST['years_of_experience'];
    $writerSpeciality = $_POST['speciality'];
    $writerRating = $_POST['rating'];
    $writerAvailability = $_POST['availability'];

    // Call the controller function to update writer details
    $result = updateWriterController($writerID, $writerName, $yearsOfExperience, $writerSpeciality, $writerRating, $writerAvailability);

    // Check if update was successful and redirect accordingly
    if ($result) {
        header("Location: ../view/writers.php?message=Writer updated successfully");
        exit();
    } else {
        header("Location: ../view/writers.php?error=Error updating writer");
        exit();
    }
} else {
    echo "Invalid request.";
    exit();
}
