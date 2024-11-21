<?php
include ('../controllers/customer_controller.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from form submission
    $fname = $_POST['fname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $country = $_POST['country'];
    $city = $_POST['city'];
    $contact = $_POST['contact'];

    // Call registerController
    $registerUser = registerController($fname, $email, $password, $country, $city, $contact);

    // Check if registration was successful
    if ($registerUser !== false) {
        // Redirect to login page with success message
        header("Location:../view/login.php");
        exit();
    } else {
        // Redirect to registration page with error message
        echo "Registration failed. Please try again.";
        header("Location:../view/register.php");
        exit();
    }
}

?>