<?php
// Include the Service class
include("../classes/service_class.php");

function addServiceController($serviceName, $serviceCategory, $servicePrice, $serviceDescription, $serviceKeywords) {
    // Create an instance of the Service class
    $newService = new Service();

    // Return the addService method
    return $newService->addService($serviceName, $serviceCategory, $servicePrice, $serviceDescription, $serviceKeywords);
}

function deleteServiceController($serviceID) {
    // Create an instance of the Service class
    $service = new Service();

    // Return the deleteService method
    return $service->deleteService($serviceID);
}

function getServicesController() {
    // Create an instance of the Service class
    $services = new Service();

    // Return the getServices method
    return $services->getServices();
}

function getOneServiceController($serviceID) {
    // Create an instance of the Service class
    $service = new Service();

    // Return the getOneService method
    return $service->getOneService($serviceID);
}

function updateServiceController($serviceID, $serviceName, $serviceCategory, $servicePrice, $serviceDescription, $serviceKeywords) {
    // Create an instance of the Service class
    $service = new Service();

    // Return the getOneService method
    return $service->editService($serviceID, $serviceName, $serviceCategory, $servicePrice, $serviceDescription, $serviceKeywords);
}


?>