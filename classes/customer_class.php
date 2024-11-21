<?php
// Connect to database class
require("../settings/db_class.php");

/**
 * Customer class to handle customer-related database functions.
 */
class Customer extends db_connection
{
    // Add a new customer to the database
    public function addCustomer($fname, $email, $password, $country, $city, $contact)
    {
        $ndb = new db_connection();

        // Sanitize inputs
        $name = mysqli_real_escape_string($ndb->db_conn(), $fname);
        $email = mysqli_real_escape_string($ndb->db_conn(), $email);
        $password = mysqli_real_escape_string($ndb->db_conn(), $password);
        $country = mysqli_real_escape_string($ndb->db_conn(), $country);
        $city = mysqli_real_escape_string($ndb->db_conn(), $city);
        $contact = mysqli_real_escape_string($ndb->db_conn(), $contact);

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // SQL query to insert a new customer
        $sql = "INSERT INTO `customer` (`customer_name`, `customer_email`, `customer_pass`, `customer_country`, `customer_city`, `customer_contact`, `user_role`) 
                VALUES ('$name', '$email', '$hashed_password', '$country', '$city', '$contact', 1)";

        // Execute query and return result
        return $this->db_query($sql);
    }

    // Check if an email already exists in the database
    public function emailExists($email)
    {
        $ndb = new db_connection();

        $email = mysqli_real_escape_string($ndb->db_conn(), $email);
        $sql = "SELECT * FROM customer WHERE customer_email = '$email'";
        $ndb->db_query($sql);
        return $ndb->db_count() > 0;
    }

    // Login function
    public function login($email, $password)
    {
        $ndb = new db_connection();

        // Sanitize inputs
        $email = mysqli_real_escape_string($ndb->db_conn(), $email);
        
        // Prepare SQL statement
        $sql = "SELECT * FROM customer WHERE customer_email = '$email'";
        $result = $ndb->db_query($sql);
        
        if ($result) {
            // Fetch the result as an associative array
            $row = mysqli_fetch_assoc($ndb->results);
            
            if ($row) {
                // Verify the password
                if (password_verify($password, $row['customer_pass'])) {
                    // Start a session and store user info
                    session_start();
                    $_SESSION['customer_id'] = $row['customer_id'];
                    $_SESSION['customer_name'] = $row['customer_name'];
                    $_SESSION['customer_email'] = $row['customer_email'];

                    // Return user data
                    return $row;
                } else {
                    // Incorrect password
                    return "Incorrect Password";
                }
            } else {
                // User not found
                return "User not found";
            }
        } else {
            return false; // Query failed
        }
    }
}
?>
