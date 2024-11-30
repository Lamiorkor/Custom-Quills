<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Custom Quills - Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-cover bg-center h-screen" style="background-image: url('../images/custom_quills_logo.png');">

    <!-- Login form container -->
    <div class="flex justify-center items-center h-full">
        <div class="bg-white shadow-lg rounded-lg p-8 w-96">
            <h2 class="text-2xl font-bold mb-6 text-center">Sign In</h2>

            <!-- Error Message -->
            <?php
            if (isset($_GET['error'])) {
                $error = $_GET['error'];
                echo "<p class='text-red-500 font-medium mb-4'>";
                if ($error == "empty_fields") {
                    echo "Please fill in all fields.";
                } elseif ($error == "incorrect_password") {
                    echo "Incorrect password. Please try again.";
                } elseif ($error == "user_not_found") {
                    echo "User not found. Please register.";
                } elseif ($error == "login_failed") {
                    echo "Login failed. Please try again.";
                }
                echo "</p>";
            }
            ?>

            <!-- Login Form -->
            <form action="../actions/login_action.php" name="loginForm" method="POST" id="loginForm">
                <!-- Email Address -->
                <label for="email" class="block text-gray-700 font-medium mb-2">Email Address:</label>
                <input type="email" id="emailInput" name="email" placeholder="Enter your email" 
                       class="border border-gray-300 rounded w-full p-2 mb-4 focus:ring focus:ring-blue-300" required>
                
                <!-- Password -->
                <label for="password" class="block text-gray-700 font-medium mb-2">Password:</label>
                <input type="password" id="passwordInput" name="password" placeholder="Enter your password" 
                       class="border border-gray-300 rounded w-full p-2 mb-4 focus:ring focus:ring-blue-300" required>
                
                <!-- Submit Button -->
                <button type="submit" name="login" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 w-full">
                    Sign In
                </button>
            </form>

            <!-- Link to sign-up page -->
            <p class="text-sm text-gray-600 mt-4 text-center">
                Don't have an account? <a href="register.php" class="text-blue-500 hover:underline">Sign Up here</a>
            </p>
        </div>
    </div>

    <!-- External JS script for validation -->
    <script src="../js/login.js"></script>
</body>

</html>
