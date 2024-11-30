<?php
include ('../controllers/service_controller.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from form submission
    $serviceName = $_POST['serviceName'];
    $serviceCategory = $_POST['serviceCategory'];
    $servicePrice = $_POST['servicePrice'];
    $serviceDescription = $_POST['serviceDesc'];
    $serviceKeywords = $_POST['serviceKeywords'];

    // Call serviceController
    $newService = addServiceController($serviceName, $serviceCategory, $servicePrice, $serviceDescription, $serviceKeywords);

    // Check if registration was successful
    if ($newService !== false) {
        // Redirect to service page with success message
        echo "Service added successfully!";
        header("Location:.../admin_view/manage_services.php");
        exit();
    } else {
        // Redirect to service page with error message
        echo "Addition of service failed. Please try again.";
        header("Location:../admin_view/manage_services.php");
        exit();
    }
}

?>
