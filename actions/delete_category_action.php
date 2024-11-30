<?php
include ('../controllers/categories_controller.php');

// Get the brand ID from the form submission
if (isset($_POST['catID'])) {
    $catID = $_POST['catID'];

     // Call brandController
     $category = deleteCategoryController($catID);

    // Instantiate and delete the brand
    if ($category !== false) {
        // Redirect to brand page with success message
        echo "Category deleted successfully!";
        header("Location:../admin_view/manage_categories.php");
        exit();
    } else {
        echo "Error deleting category";
        header("Location:../admin_view/manage_categories.php");
        exit();
    }
}

?>