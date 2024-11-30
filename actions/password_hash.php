<?php
$password = "K!llers123";
$hash = password_hash($password, PASSWORD_DEFAULT);
$verify = password_verify($password, $hash); // Correct order
echo "Original password: " . $password . "\n";
echo "Hashed password: " . $hash . "\n";
var_dump($verify); // This will output `bool(true)`

?>