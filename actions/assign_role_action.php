<?php

session_start();
require_once ('../controllers/user_controller.php');

// Check if form is submitted
if (isset($_POST['updateRole'])) {
    // Check if user ID and new role are set and not empty
    if (isset($_POST['userID'], $_POST['role']) && !empty($_POST['userID']) && !empty($_POST['role'])) {
        // Get input values
        $userID = $_POST['userID'];
        $newRole = $_POST['role'];

        // Call reviewRoleRequestController
        $updatedRole = reviewRoleRequestController($userID, $newRole);

        // Check if role update was successful
        if ($updatedRole) {
            // Redirect to roles page with success message
            echo "Role updated successfully!";
            header("Location: ../admin_view/manage_users.php");
            exit();
        } else {
            // Redirect to roles page with error message
            echo "Error updating role";
            header("Location: ../admin_view/manage_users.php");
            exit();
        }
    }
}