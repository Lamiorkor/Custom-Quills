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

        $hashed_password = password_hash($user_password, PASSWORD_DEFAULT);

        // Insert into users table with pending role
        $sql = "INSERT INTO `users` (`name`, `email`, `password`) 
                VALUES ('$user_name', '$user_email', '$hashed_password')";

        if ($this->db_query($sql)) {
            $user_id = $this->get_insert_id(); // Get the new user ID

            // Add customer-specific data (default for all new users)
            $customer_country = mysqli_real_escape_string($ndb->db_conn(), $country);
            $customer_city = mysqli_real_escape_string($ndb->db_conn(), $city);
            $customer_contact = mysqli_real_escape_string($ndb->db_conn(), $phoneNumber);
            $requested_role = mysqli_real_escape_string($ndb->db_conn(), $requestedRole);

            $customerSql = "INSERT INTO `customers` (`user_id`, `country`, `city`, `phone_number`) 
                            VALUES ('$user_id', '$customer_country', '$customer_city', '$customer_contact')";

            $roleSql = "INSERT INTO `role_requests` (`user_id`, `role_requested`)
                        VALUES ('$user_id', '$requested_role')";

            if (!$this->db_query($customerSql) || !$this->db_query($roleSql)) {
                return false;
            } else {
                return true;
            }
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
        $sql = "UPDATE `users` SET `role` = '$approvedRole'
                WHERE `user_id` = '$user_id'";

        if ($ndb->db_query($sql)) {
            $roleSql = "DELETE FROM `role_requests` WHERE `user_id` = '$user_id'";
            return $this->db_query($roleSql);
        }
        return false;
    }

    public function getPendingRoleRequests()
    {
        $sql = "SELECT `role_requests`.`user_id`, `role_requests`.`role_requested`, `users`.`name`, `users`.`role` 
                FROM `role_requests` 
                JOIN `users` ON `role_requests`.`user_id` = `users`.`user_id`
                WHERE `role_requests`.`status` = 'pending'";

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
        $ndb = new db_connection();

        $sql = "SELECT `users`.`user_id`, `users`.`name`, `writers`.`years_of_experience`, `writers`.`speciality`, 
                        `writers`.`rating`, `writers`.`availability_status` 
                FROM `users` 
                INNER JOIN `writers` ON `users`.`user_id` = `writers`.`user_id` 
                WHERE `users`.`role` = 'writer'";

        if ($ndb->db_query($sql)) {
            return $ndb->db_fetch_all();
        } else {
            return [];
        }
    }

    public function getAllUsers() 
    {
        $ndb = new db_connection();
    
        $sql = "SELECT * FROM `users`";
        $result = $ndb->db_query($sql);
    
        if ($result) {
            return $ndb->db_fetch_all(); 
        } else {
            return []; 
        }
    }

    public function getOneUserDetails($userID) {
        $ndb = new db_connection();

        $user_id = mysqli_real_escape_string($ndb->db_conn(), $userID);

        $sql = "SELECT * FROM `users` WHERE `user_id` = '$user_id'";
        $result = $ndb->db_query($sql);

        if ($result) {
            return $this->db_fetch_one($sql);
        } else {
            return [];
        }
    }

    // Update user information
    public function updateUser($userID, $userName, $userEmail, $password, $userRole, $country = null, $city = null, $phoneNumber = null, $yearsOfExperience = null, $speciality = null, $availability = null)
    {
        $ndb = new db_connection();

        $user_id = mysqli_real_escape_string($ndb->db_conn(), $userID);
        $user_name = mysqli_real_escape_string($ndb->db_conn(), $userName);
        $user_email = mysqli_real_escape_string($ndb->db_conn(), $userEmail);
        $password = mysqli_real_escape_string($ndb->db_conn(), $password);
        $user_role = mysqli_real_escape_string($ndb->db_conn(), $userRole);

        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Update the user's basic details
        $sql = "UPDATE `users` 
                SET `name` = '$user_name', `email` = '$user_email', `password` = '$hashed_password', `role` = '$user_role'
                WHERE `user_id` = '$user_id'";

        if ($ndb->db_query($sql)) {
            // Handle customer-specific data
            if ($user_role == 'customer') {
                $customer_country = mysqli_real_escape_string($ndb->db_conn(), $country);
                $customer_city = mysqli_real_escape_string($ndb->db_conn(), $city);
                $customer_contact = mysqli_real_escape_string($ndb->db_conn(), $phoneNumber);

                $customerSql = "UPDATE `customers` 
                                SET `country` = '$customer_country', `city` = '$customer_city', `phone_number` = '$customer_contact'
                                WHERE `user_id` = '$user_id'";

                return $ndb->db_query($customerSql);
            }
            // Handle writer-specific data
            elseif ($user_role == 'writer') {
                $years_of_experience = mysqli_real_escape_string($ndb->db_conn(), $yearsOfExperience);
                $speciality = mysqli_real_escape_string($ndb->db_conn(), $speciality);
                $availability = mysqli_real_escape_string($ndb->db_conn(), $availability);

                $writerSql = "UPDATE `writers` 
                              SET `years_of_experience` = '$years_of_experience', `speciality` = '$speciality', `availability_status` = '$availability'
                              WHERE `user_id` = '$user_id'";

                return $ndb->db_query($writerSql);
            }

            return true; // Basic user details updated
        }

        return false; // Failed to update user
    }

    public function editUserRole($userID, $userRole)
    {
        $ndb = new db_connection();

        $user_id = mysqli_real_escape_string($ndb->db_conn(), $userID);
        $user_role = mysqli_real_escape_string($ndb->db_conn(), $userRole);

        $sql = "UPDATE `users` SET `role` = '$user_role' WHERE `user_id` = '$user_id'";

        return $ndb->db_query($sql);

    }

    public function requestRoleChange($userID, $requestedRole) {
        $ndb = new db_connection();

        $user_id = mysqli_real_escape_string($ndb->db_conn(), $userID);
        $requested_role = mysqli_real_escape_string($ndb->db_conn(), $requestedRole);

        $sql = "INSERT INTO `role_requests` (`user_id`, `role_requested`)
                VALUES ('$user_id', '$requested_role')";

        return $ndb->db_query($sql);
    }

    public function getCustomerDetails($userID) {
        $ndb = new db_connection();

        $user_id = mysqli_real_escape_string($ndb->db_conn(), $userID);

        $sql = "SELECT * FROM `customers` WHERE `user_id` = '$user_id'";
        $result = $ndb->db_query($sql);

        if ($result) {
            return $this->db_fetch_one($sql);
        } else {
            return [];
        }
    }

    public function deleteUser($userID)
    {
        $ndb = new db_connection();

        $user_id = mysqli_real_escape_string($ndb->db_conn(), $userID);

        $sql = "DELETE FROM `users` WHERE `user_id` = '$user_id'";

        return $ndb->db_query($sql);
    }
    
}

?>
