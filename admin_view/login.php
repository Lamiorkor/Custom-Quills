<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Custom Quills - Login</title>
    <link rel="stylesheet" href="../css/login.css">
</head>

<body>

    <!-- Login form container -->
    <form action="../actions/login_action.php" name="loginForm" method="POST" id="loginForm">
        <div class="grid-container">
            <div class="grid-item">Email Address</div>
            <div class="grid-item"><input type="email" id="emailInput" name="email" placeholder="Enter your email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" required></div>

            <div class="grid-item">Password</div>
            <div class="grid-item"><input type="password" id="passwordInput" name="password" placeholder="Enter your password" pattern="^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$" required></div>
            
            <div class="grid-item" colspan="2">
                <button type="submit" name="login"><b>Sign In</b></button>
            </div>

            <!-- Link to sign-up page -->
            <div class="sign_up-link">
                <p>Don't have an account? <a href="register.php">Sign Up here</a></p>
            </div>
        </div>
    </form>

    <!-- External JS script -->
    <script src="../js/login.js"></script>
</body>

</html>
