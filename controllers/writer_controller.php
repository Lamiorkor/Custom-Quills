<?php
// Include the brand class
include("../classes/writer_class.php");

function addWriterController($writerName, $yearsOfExperience, $writerSpeciality) {
    // Create an instance of the Brand class
    $newWriter = new Writer();

    // Return the addBrand method
    return $newWriter->addWriter($writerName, $yearsOfExperience, $writerSpeciality);
}

function deleteWriterController($writerID) {
    $writer = new Writer();

    // Return the deleteBrand method
    return $writer->deleteWriter($writerID);
}

function getWritersController() {
    // Create an instance of the Brand class
    $writers = new Writer();

    // Return the getBrands method
    return $writers->getWriters();
}
?>