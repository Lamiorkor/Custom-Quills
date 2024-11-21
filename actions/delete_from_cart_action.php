<?php
include ('../controllers/cart_controller.php');

session_start();

// Get the service ID from the form submission
if (isset($_POST['serviceID'])) {
    $serviceID = $_POST['serviceID'];
    $customerID = $_SESSION['user_id'];

    // Call deleteCartItemController
    $cart_item = deleteCartItemController($serviceID, $customerID);

    // Instantiate and delete the cart item
    if ($cart_item !== false) {
        // Redirect to cart page with success message
        echo "Cart item deleted successfully!";
        header("Location:../view/cart.php");
        exit();
    } else {
        echo "Error deleting cart item";
        header("Location:../view/cart.php");
        exit();
    }
}

?>