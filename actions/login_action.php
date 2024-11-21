<?php
include ("../controllers/customer_controller.php");

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if email and password are set and not empty
    if (isset($_POST["email"]) && isset($_POST["password"]) && !empty($_POST["email"]) && !empty($_POST["password"])) {
        // Get input values
        $email = $_POST["email"];
        $password = $_POST["password"];

        // Login user
        $user = loginController($email, $password);

        // Check if login was successful
        if ($user !== null) {
            // Start session
            session_start();

            // Store user data in session
            $_SESSION['user_id'] = $user['customer_id'];
            $_SESSION['user_email'] = $user['customer_email'];
            $_SESSION['user_name'] = $user['customer_name'];

            header("Location: ../view/brands.php");
        } else {
            // Redirect back to login page with error message
            header("Location: ../view/login.php");
            echo "Error: You are not registered";
            exit();
        } 
    } else {
        // Redirect back to login page with error message
        header("Location: ../view/login.php");
        echo "Error: Empty fields";
        exit();
    }
} else {
    // Redirect back to login page
    header("Location: ../view/login.php");
    exit();
}

?>