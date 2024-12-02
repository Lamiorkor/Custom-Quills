<?php
require_once('../controllers/writer_controller.php');

if (isset($_POST['action']) && $_POST['action'] === 'add') {
    $userID = $_POST['user_id'];
    $yearsOfExperience = $_POST['years_of_experience'];
    $speciality = $_POST['speciality'];
    $rating = $_POST['rating'];
    $availability = $_POST['availability'];

    // Call the controller
    $result = addWriterController($userID, $yearsOfExperience, $speciality, $rating, $availability);

    if ($result) {
        header("Location: ../admin_view/manage_writers.php?success=writer_added");
        exit();
    } else {
        header("Location: ../admin_view/add_writer.php?error=failed_to_add");
        exit();
    }
}
?>
