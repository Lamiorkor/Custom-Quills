<?php
include ('../controllers/service_controller.php');

// Get the service ID from the form submission
if (isset($_POST['serviceID'])) {
    $serviceID = $_POST['serviceID'];

     // Call serviceController
     $service = deleteServiceController($serviceID);

    // Instantiate and delete the service
    if ($service !== false) {
        // Redirect to service page with success message
        echo "Service deleted successfully!";
        header("Location:../view/services.php");
        exit();
    } else {
        echo "Error deleting service";
        header("Location:../view/services.php");
        exit();
    }
}

?>