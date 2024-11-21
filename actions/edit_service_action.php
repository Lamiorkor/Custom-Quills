<?php
// Including necessary files and classes
include ('../controllers/service_controller.php');

// Checking if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $serviceID = $_POST['service_id'];
    $serviceName = $_POST['service_name'];
    $serviceCategory = $_POST['service_category'];
    $servicePrice = $_POST['service_price'];
    $serviceDescription = $_POST['service_desc'];
    $serviceKeywords = $_POST['service_keywords'];

    // Call the update controller
    $result = updateServiceController($serviceID, $serviceName, $serviceCategory, $servicePrice, $serviceDescription, $serviceKeywords);

    // Check if update was successful
    if ($result) {
        // Redirect to success page or show a success message
        header("Location: ../view/services.php?status=success");
        exit(); // Exit after redirecting
    } else {
        // Redirect to error page or show an error message
        header("Location: ../view/services.php?status=error");
        exit(); // Exit after redirecting
    }
}