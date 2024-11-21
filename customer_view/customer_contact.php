<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="../css/contact.css">
</head>
<body>

    <!-- Navigation Bar -->
    <nav>
        <ul>
            <li><a href="customer_services.php">Services</a></li>
            <li><a href="customer_writers.php">Writers</a></li>
            <li><a href="customer_orders.php">Orders</a></li>
            <li><a href="customer_contact.php">Contact</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>
    
    <div class="signup-container">
        <h2>Get in Touch</h2>
        <p><i>Please fill out the form below:</i></p>

        <form action="../actions/contact_action.php" method="POST" id="contactForm">
            <label for="name">Your Name:</label>
            <input type="text" id="name" name="name" placeholder="Enter your name" required>

            <label for="email">Your Email:</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required>

            <label for="message">Message:</label>
            <textarea id="message" name="message" placeholder="Type your message here..." required></textarea>

            <button type="submit">Send Message</button>
        </form>

        <p class="login-link">Need help? <a href="support.php">Contact Support</a></p>
    </div>

    <script src="../js/contact.js"></script>
</body>
</html>
