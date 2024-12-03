<?php
// Include the writer class
include("../classes/writer_class.php");

function addWriterController($userID, $yearsOfExperience, $speciality, $rating, $availability) {
    $writer = new Writer();
    return $writer->addWriter($userID, $yearsOfExperience, $speciality, $rating, $availability);
}

function deleteWriterController($writerID) {
    $writer = new Writer();

    // Return the deleteWriter method
    return $writer->deleteWriter($writerID);
}

function getWritersController() {
    // Create an instance of the Writer class
    $writers = new Writer();

    // Return the getWriters method
    return $writers->getWriters();
}

function adminUpdateWriterController($writerID, $yearsOfExperience, $writerSpeciality, $writerRating, $writerAvailability) {
    $writer = new Writer();

    // Return the updateWriter method
    return $writer->adminUpdateWriter($writerID, $yearsOfExperience, $writerSpeciality, $writerRating, $writerAvailability);
}

function updateWriterController($user_id, $user_name, $user_email, $password, $years_of_experience, $speciality, $availability) {
    $writer = new Writer();
    return $writer->updateWriter($user_id, $user_name, $user_email, $password, $years_of_experience, $speciality, $availability);
}

function getOneWriterController($writerID) {
    $writer = new Writer();

    // Return the getWriter method
    return $writer->getOneWriter($writerID);
}

function addWriterRequestsController($orderID, $writerID, $orderStatus, $dateCreated) {
    $writer = new Writer();
    return $writer->addWriterRequest($orderID, $writerID, $orderStatus, $dateCreated);
}

function getWriterRequestsController($writerID) {
    $writer = new Writer();
    return $writer->getWriterRequests($writerID);
}

function acceptOrderController($writerID, $orderID)
{
    // Create an instance of the Writer class
    $writer = new Writer();

    // Call the method to update the order status to 'in progress'
    return $writer->acceptOrder($writerID, $orderID);
}

?>
