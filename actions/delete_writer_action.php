<?php
include ('../controllers/brand_controller.php');

// Get the brand ID from the form submission
if (isset($_POST['brandID'])) {
    $brandID = $_POST['brandID'];

     // Call brandController
     $brand = deleteBrandController($brandID);

    // Instantiate and delete the brand
    if ($brand !== false) {
        // Redirect to brand page with success message
        echo "Brand deleted successfully!";
        header("Location:../view/brands.php");
        exit();
    } else {
        echo "Error deleting brand";
        header("Location:../view/brands.php");
        exit();
    }
}

?>