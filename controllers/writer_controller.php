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

function updateWriterController($writerID, $writerName, $yearsOfExperience, $writerSpeciality, $writerRating, $writerAvailability) {
    $writer = new Writer();

    // Return the updateWriter method
    return $writer->updateWriter($writerID, $writerName, $yearsOfExperience, $writerSpeciality, $writerRating, $writerAvailability);
}

function getOneWriterController($writerID) {
    $writer = new Writer();

    // Return the getWriter method
    return $writer->getOneWriter($writerID);
}
?>
