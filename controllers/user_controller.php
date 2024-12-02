<?php

// Include the User class
include "../classes/user_class.php";

/**
 * Register a new user and add their role-specific data (default is customer).
 */
function registerController($name, $email, $password, $requested_role, $country, $city, $phoneNumber)
{
    // Create an instance of the User class
    $new_user = new User();

    // Call the addUser method
    return $new_user->addUser($name, $email, $password, $requested_role, $country, $city, $phoneNumber);
}

/**
 * Login an existing user.
 */
function loginController($email, $password)
{
    // Create an instance of the User class
    $user = new User();

    // Call the login method
    return $user->login($email, $password);
}

/**
 * Check if an email already exists.
 */
function emailExistsController($email)
{
    // Create an instance of the User class
    $user = new User();

    // Call the emailExists method
    return $user->emailExists($email);
}

/**
 * Approve or reject a role request.
 */
function reviewRoleRequestController($user_id, $approvedRole)
{
    // Create an instance of the User class
    $user = new User();

    // Call the reviewRoleRequest method
    return $user->reviewRoleRequest($user_id, $approvedRole);
}

/**
 * Get all pending role requests.
 */
function getPendingRoleRequestsController()
{
    // Create an instance of the User class
    $user = new User();

    // Call the getPendingRoleRequests method
    return $user->getPendingRoleRequests();
}

/**
 * Add writer details for a user.
 */
function addWriterDetailsController($user_id, $years_of_experience, $speciality, $rating = 0, $availability_status = 'available')
{
    // Create an instance of the User class
    $user = new User();

    // Call the addWriterDetails method
    return $user->addWriterDetails($user_id, $years_of_experience, $speciality, $rating, $availability_status);
}

/**
 * Get all writers with their details.
 */
function getAllWritersController()
{
    // Create an instance of the User class
    $user = new User();

    // Call the getAllWriters method
    return $user->getAllWriters();
}

function getAllUsersController()
{
    // Create an instance of the User class
    $user = new User();

    // Call the getAllUsers method
    return $user->getAllUsers();
}


?>