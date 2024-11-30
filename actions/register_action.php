<?php
include('../controllers/user_controller.php'); // Update the include path to match your file structure

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from form submission
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $passwordRetype = $_POST['passwordRetype'];
    $requested_role = trim($_POST['role']);
    $country = trim($_POST['country']);
    $city = trim($_POST['city']);
    $contact = trim($_POST['contact']);

    // Basic form validation
    if (empty($name) || empty($email) || empty($password) || empty($requested_role) || empty($country) || empty($city) || empty($contact)) {
        header("Location: ../view/register.php?error=empty_fields");
        exit();
    }

    // Call the registerController
    $registerUser = registerController($name, $email, $password, $requested_role, $country, $city, $contact);

    // Check if registration was successful
    if ($registerUser !== false) {
        // Redirect to login page with success message
        header("Location: ../view/login.php?success=registered");
        exit();
    } else {
        // Redirect to registration page with error message
        header("Location: ../view/register.php?error=registration_failed");
        exit();
    }
} else {
    // Redirect back to the registration page if accessed directly
    header("Location: ../view/register.php");
    exit();
}
