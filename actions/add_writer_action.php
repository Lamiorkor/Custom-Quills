<?php
include ('../controllers/writer_controller.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from form submission
    $writerName = $_POST['writerName'];
    $yearsOfExperience = $_POST['experience'];
    $writerSpeciality = $_POST['speciality'];

    // Call Writer Controller
    $newWriter = addWriterController($writerName, $yearsOfExperience, $writerSpeciality);

    // Check if addition was successful
    if ($newWriter !== false) {
        // Redirect to writer page with success message
        echo "Writer added successfully!";
        header("Location:../view/writers.php");
        exit();
    } else {
        // Redirect to brand page with error message
        echo "Addition of brand failed. Please try again.";
        header("Location:../view/brands.php");
        exit();
    }
}

?>
