<?php
require_once ("../controllers/user_controller.php"); 

// Check if form is submitted
if (isset($_POST['login'])) {
    // Check if email and password are set and not empty
    if (isset($_POST['email'], $_POST['password']) && !empty($_POST['email']) && !empty($_POST['password'])) {
        // Get input values
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Attempt login
        $user = loginController($email, $password);

        if (is_array($user)) { // Login successful, $user contains user data
            // Start session
            session_start();

            // Store user data in session
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_role'] = $user['role'];

            // Redirect based on user role
            if ($_SESSION['user_role'] === 'customer') { // Customer
                header("Location: ../customer_view/customer_dashboard.php");
                exit();
            } elseif ($_SESSION['user_role'] === 'writer') { // Writer
                header("Location: ../writer_view/writer_dashboard.php");
                exit();
            } elseif ($_SESSION['user_role'] === 'administrator') { // Admin
                header("Location: ../admin_view/admin_dashboard.php");
                exit();
            } else {
                // Redirect to a general dashboard or error page for undefined roles
                header("Location: ../view/homepage.php");
                exit();
            }
        } elseif ($user === "Incorrect Password") {
            // Redirect back with error message
            header("Location: ../view/login.php?error=incorrect_password");
            exit();
        } elseif ($user === "User not found") {
            // Redirect back with error message
            header("Location: ../view/login.php?error=user_not_found");
            exit();
        } else {
            // General error (e.g., database query failed)
            header("Location: ../view/login.php?error=login_failed");
            exit();
        }
    } else {
        // Redirect back to login page with error message for empty fields
        header("Location: ../view/login.php?error=empty_fields");
        exit();
    }
} else {
    // Redirect to login page for invalid request methods
    header("Location: ../view/login.php");
    exit();
}

?>