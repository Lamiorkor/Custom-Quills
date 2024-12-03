<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include ('../controllers/user_controller.php');

// Get the user ID from the form submission
if (isset($_POST['userID'])) {
    $userID = $_POST['userID'];

     // Call userController
     $user = deleteUserController($userID);

    // Instantiate and delete the user
    if ($user !== false) {
        // Redirect to user page with success message
        echo "User deleted successfully!";
        header("Location:../admin_view/manage_users.php");
        exit();
    } else {
        echo "Error deleting user";
        header("Location:../admin_view/manage_users.php");
        exit();
    }
}

?>