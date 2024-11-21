<?php
// Include the customer class
include "../classes/customer_class.php";

function registerController($fname, $email, $password, $country, $city, $contact) {
    // Create an instance of the Customer class
    $new_user = new Customer();

    // Return the register method
    return $new_user->addCustomer($fname, $email, $password, $country, $city, $contact);
}

function loginController($email, $password) {
    // Create an instance of the Customer class
    $old_user = new Customer();
    
    // Return the login method
    return $old_user->login($email, $password); 
}

?>