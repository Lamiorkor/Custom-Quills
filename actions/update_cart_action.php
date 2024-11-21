<?php
include ('../controllers/cart_controller.php'); // Include the controller

session_start();

if (isset($_POST['action']) && isset($_POST['serviceID'])) {
    $serviceID = $_POST['serviceID'];
    $customerID = $_SESSION['user_id'];
    $quantity = 1;
    
    // Check if the action is 'increase' or 'decrease'
    if ($_POST['action'] == 'increase') {
        $increment = increaseCartItemQtyController($serviceID, $customerID, $quantity); // Call the controller function to increase quantity
        if ($increment) {
            echo "Quantity increased";
            header('Location: ../view/cart.php');
            exit();
        }
    } elseif ($_POST['action'] == 'decrease') {
        $decrement = decreaseCartItemQtyController($serviceID, $customerID, $quantity); // Call the controller function to decrease quantity
        if ($decrement) {
            echo "Quantity decreased";
            header('Location:../view/cart.php');
            exit();
        }
    }
}

// Redirect back to the cart page after the update
header('Location: ../view/cart.php');
exit();
?>
