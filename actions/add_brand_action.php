<?php
include ('../controllers/brand_controller.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from form submission
    $brandName = $_POST['brandName'];

    // Call brandController
    $newBrand = addBrandController($brandName);

    // Check if registration was successful
    if ($newBrand !== false) {
        // Redirect to brand page with success message
        echo "Brand added successfully!";
        header("Location:../view/brands.php");
        exit();
    } else {
        // Redirect to brand page with error message
        echo "Addition of brand failed. Please try again.";
        header("Location:../view/brands.php");
        exit();
    }
}

?>
