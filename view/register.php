<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Custom Quills - Sign Up</title>
    <link rel="stylesheet" href="../css/register.css"> <!-- Link to the CSS -->
</head>

<body>

    <!-- Signup form container -->
    <div class="signup-container">
        <h2>Sign Up</h2>
        <p><i>Kindly enter the following information to register:</i></p>

        <!-- Signup form -->
        <form action="../actions/register_action.php" name="signupForm" method="POST" id="signupForm">
            <label for="fname">Full Name:</label>
            <input type="text" id="fname" name="fname" placeholder="Enter your full name" required>

            <label for="email">Email Address:</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required>

            <label for="passwordRetype">Retype Password:</label>
            <input type="password" id="passwordRetype" name="passwordRetype" placeholder="Re-enter your password" required>
    
            <label for="country">Country:</label>
            <input type="text" id="country" name="country" placeholder="Enter your country" required>

            <label for="city">City:</label>
            <input type="text" id="city" name="city" placeholder="Enter your city" required>
        
            <label for="contact">Contact Number:</label>
            <input type="text" id="contact" name="contact" placeholder="e.g. +233890982765" required>
           
            <button type="submit" name="register">Sign Up</button>
        </form>

        <!-- Link to login page -->
        <p class="login-link">Already have an account? <a href="login.php">Login here</a></p>
    </div>

    <!-- External JS script for validation -->
    <script src="../js/register.js"></script>
</body>

</html>
