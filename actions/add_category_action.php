<?php
include ('../controllers/categories_controller.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from form submission
    $catName = $_POST['catName'];

    // Call brandController
    $newCat = addCategoryController($catName);

    // Check if registration was successful
    if ($newCat !== false) {
        // Redirect to brand page with success message
        echo "Category added successfully!";
        header("Location:../admin_view/manage_categories.php");
        exit();
    } else {
        // Redirect to brand page with error message
        echo "Addition of category failed. Please try again.";
        header("Location:../admin_view/manage_categories.php");
        exit();
    }
}

?>
