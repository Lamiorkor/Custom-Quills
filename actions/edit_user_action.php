<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require_once('../controllers/user_controller.php');
require_once('../controllers/writer_controller.php');

// Ensure the form submission is valid
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = isset($_POST['user_id']) ? intval($_POST['user_id']) : null;
    $user_name = isset($_POST['user_name']) ? trim($_POST['user_name']) : null;
    $user_email = isset($_POST['user_email']) ? trim($_POST['user_email']) : null;
    $user_role = isset($_POST['user_role']) ? trim($_POST['user_role']) : null;
    $password = isset($_POST['password']) ? trim($_POST['password']) : null;
    
    // Customer-specific fields
    $country = isset($_POST['country']) ? $_POST['country'] : null;
    $city = isset($_POST['city']) ? $_POST['city'] : null;
    $phone_number = isset($_POST['phone_number']) ? $_POST['phone_number'] : null;
    
    // Writer-specific fields
    $years_of_experience = isset($_POST['years_of_experience']) ? $_POST['years_of_experience'] : null;
    $speciality = isset($_POST['speciality']) ? $_POST['speciality'] : null;
    $availability = isset($_POST['availability']) ? $_POST['availability'] : null;

    if ($user_id && $user_name && $user_email && $password) {
        if ($_SESSION['user_role'] === 'administrator') {
            $result = updateUserController($user_id, $user_name, $user_email, $password, $user_role);

            if ($result) {
                $_SESSION['success_message'] = "User updated successfully.";
                header('Location: ../admin_view/manage_users.php');
                exit();
            } else {
                $_SESSION['error_message'] = "Failed to update user.";
                header('Location: ../admin_view/manage_users.php');
                exit();
            }

        } elseif ($_SESSION['user_role'] === 'customer') {
            $result = updateUserController($user_id, $user_name, $user_email, $password, 'customer', $country, $city, $phone_number);
            $role_result = requestRoleChangeController($user_id, $user_role);

            if ($result && $role_result) {
                $_SESSION['success_message'] = "User updated successfully.";
                header('Location:../customer_view/user_profile.php');
                exit();
            } else {
                $_SESSION['error_message'] = "Failed to update user.";
                header('Location:../customer_view/user_profile.php');
                exit();
            }

        } elseif ($_SESSION['user_role'] === 'writer') {
            $result = updateWriterController($user_id, $user_name, $user_email, $password, $years_of_experience, $speciality, $availability);

            if ($result) {
                $_SESSION['success_message'] = "Writer updated successfully.";
                header('Location: ../writer_view/user_profile.php');
                exit();
            } else {
                $_SESSION['error_message'] = "Failed to update writer.";
                header('Location: ../writer_view/user_profile.php');
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
