<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
        
include ('../controllers/writer_controller.php');

// Get the writer ID from the form submission
if (isset($_POST['writerID'])) {
    $writerID = $_POST['writerID'];

     // Call writerController
     $writer = deleteWriterController($writerID);

    // Instantiate and delete the writer
    if ($writer !== false) {
        // Redirect to writer page with success message
        echo "Writer deleted successfully!";
        header("Location:../admin_view/manage_writers.php");
        exit();
    } else {
        echo "Error deleting writer";
        header("Location:../admin_view/manage_writers.php");
        exit();
    }
}

?>