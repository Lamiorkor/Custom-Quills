<?php
require("../settings/db_class.php");

/**
 * User class to handle user-related database functions.
 */
class User extends db_connection
{
    /**
     * Add a new user and their role-specific data (default role is customer).
     */
    public function addUser($name, $email, $password, $requestedRole, $country, $city, $phoneNumber)
    {
        $ndb = new db_connection();

        // Sanitize inputs
        $user_name = mysqli_real_escape_string($ndb->db_conn(), $name);
        $user_email = mysqli_real_escape_string($ndb->db_conn(), $email);
        $user_password = mysqli_real_escape_string($ndb->db_conn(), $password);
        $requested_role = mysqli_real_escape_string($ndb->db_conn(), $requestedRole);

        $hashed_password = password_hash($user_password, PASSWORD_DEFAULT);

        // Insert into users table with pending role
        $sql = "INSERT INTO `users` (`name`, `email`, `password`, `requested_role`) 
                VALUES ('$user_name', '$user_email', '$hashed_password', '$requested_role')";

        if ($this->db_query($sql)) {
            $user_id = $this->get_insert_id(); // Get the new user ID

            // Add customer-specific data (default for all new users)
            $customer_country = mysqli_real_escape_string($ndb->db_conn(), $country);
            $customer_city = mysqli_real_escape_string($ndb->db_conn(), $city);
            $customer_contact = mysqli_real_escape_string($ndb->db_conn(), $phoneNumber);

            $customerSql = "INSERT INTO `customers` (`user_id`, `country`, `city`, `phone_number`) 
                            VALUES ('$user_id', '$customer_country', '$customer_city', '$customer_contact')";
            return $this->db_query($customerSql);
        }

        return false;
    }


    /**
     * Update a user's role (e.g., change customer to writer or admin).
     */
    public function reviewRoleRequest($user_id, $approvedRole)
    {
        $ndb = new db_connection();

        // Sanitize inputs
        $user_id = mysqli_real_escape_string($ndb->db_conn(), $user_id);
        $approvedRole = mysqli_real_escape_string($ndb->db_conn(), $approvedRole);

        // Update the user's role in the database
        $sql = "UPDATE `users` SET `role` = '$approvedRole', `requested_role` = NULL 
                WHERE `user_id` = '$user_id'";
        return $this->db_query($sql);
    }

    public function getPendingRoleRequests()
    {
        $sql = "SELECT `user_id`, `name`, `email`, `requested_role` FROM `users` 
                WHERE `role` = 'pending'";
        if ($this->db_query($sql)) {
            return $this->db_fetch_all();
        } else {
            return [];
        }
    }


    /**
     * Add a writer's specific details.
     */
    public function addWriterDetails($user_id, $years_of_experience, $speciality, $rating = 0, $availability_status = 'available')
    {
        $ndb = new db_connection();

        // Sanitize inputs
        $user_id = mysqli_real_escape_string($ndb->db_conn(), $user_id);
        $years_of_experience = mysqli_real_escape_string($ndb->db_conn(), $years_of_experience);
        $speciality = mysqli_real_escape_string($ndb->db_conn(), $speciality);
        $rating = mysqli_real_escape_string($ndb->db_conn(), $rating);
        $availability_status = mysqli_real_escape_string($ndb->db_conn(), $availability_status);

        $sql = "INSERT INTO `writers` (`user_id`, `years_of_experience`, `speciality`, `rating`, `availability_status`) 
                VALUES ('$user_id', '$years_of_experience', '$speciality', '$rating', '$availability_status')";
        return $this->db_query($sql);
    }

    /**
     * Check if an email already exists in the users table.
     */
    public function emailExists($email)
    {
        $ndb = new db_connection();
        $email = mysqli_real_escape_string($ndb->db_conn(), $email);

        $sql = "SELECT * FROM `users` WHERE `email` = '$email'";
        $this->db_query($sql);
        return $this->db_count() > 0;
    }

    /**
     * User login.
     */
    public function login($email, $password)
    {
        $ndb = new db_connection();

        // Sanitize inputs
        $email = mysqli_real_escape_string($ndb->db_conn(), $email);

        $sql = "SELECT * FROM `users` WHERE `email` = '$email'";
        $result = $ndb->db_query($sql);

        if ($result) {
            $row = $this->db_fetch_one($sql); // Fetch user record

            if ($row) {
                if (password_verify($password, $row['password'])) {

                    // session_start();
                    // $_SESSION['user_id'] = $row['user_id'];
                    // $_SESSION['user_name'] = $row['name'];
                    // $_SESSION['user_email'] = $row['email'];
                    // $_SESSION['role'] = $row['role'];

                    return $row; // Login successful
                } else {
                    return "Incorrect Password";
                }
            } else {
                return "User not found";
            }
        }
        return false;
    }

    /**
     * Fetch all writers.
     */
    public function getAllWriters()
    {
        $sql = "SELECT `users`.`user_id`, `users`.`name`, `writers`.`years_of_experience`, `writers`.`speciality`, `writers`.`rating`, `writers`.`availability_status` 
                FROM `users` 
                INNER JOIN `writers` ON `users`.`user_id` = `writers`.`user_id` 
                WHERE `users`.`role` = 'writer'";

        if ($this->db_query($sql)) {
            return $this->db_fetch_all();
        } else {
            return [];
        }
    }

    public function getAllUsers() 
    {
        $ndb = new db_connection();

        $sql = "SELECT * FROM `users`";

        if ($ndb->db_query($sql)) {
            return $this->db_fetch_all();
        } else {
            return [];
        }
    }
}

?>
