<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include ('../controllers/cart_controller.php');

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from form submission
    $serviceID = $_POST['serviceID'];
    $customerID = $_SESSION['user_id'];
    $writerID = 1;
    $quantity = 1;

    // Call addToCartController
    $newCartItem = addToCartController($serviceID, $customerID, $writerID, $quantity);

    // Check if addition was successful
    if ($newCartItem !== false) {
        // Redirect to service page with success message
        echo "Item added to cart successfully!";
        header("Location:../customer_view/customer_services.php");
        exit();
    } else {
        // Redirect to service page with error message
        echo "Addition to cart failed. Please try again.";
        header("Location:../customer_view/customer_services.php");
        exit();
    } 
}

?>
