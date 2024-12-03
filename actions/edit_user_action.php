<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require_once('../controllers/user_controller.php');

// Ensure the form submission is valid
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = isset($_POST['user_id']) ? intval($_POST['user_id']) : null;
    $user_role = isset($_POST['user_role']) ? trim($_POST['user_role']) : null;
    
    if ($user_id && $user_role) {
        if ($_SESSION['user_role'] === 'administrator') {
            $result = editUserRole($user_id, $user_role);

            if ($result) {
                $_SESSION['success_message'] = "User role updated successfully.";
                header('Location: ../admin_view/manage_users.php');
                exit();
            } else {
                $_SESSION['error_message'] = "Failed to update user role.";
                header('Location: ../admin_view/manage_users.php');
                exit();
            }
        }
    } else {
        $_SESSION['error_message'] = "All fields are required.";
        header("Location: {$_SERVER['HTTP_REFERER']}");
        exit();
    }
} else {
    header("Location: ../view/login.php");
    exit();
}
