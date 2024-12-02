<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Custom Quills - Checkout</title>
    <link rel="stylesheet" href="../css/checkout.css">
</head>

<body>
    <h1>Custom Quills</h1>
    <h2><i>Poetry made for you</i></h2>

<!-- Navigation Bar -->
<nav>
        <ul>
            <li><a href="customer_services.php">Services</a></li>
            <li><a href="customer_writers.php">Writers</a></li>
            <li><a href="customer_orders.php">Orders</a></li>
            <li><a href="customer_contact.php">Contact</a></li>
            <li><a href="customer_messages.php" class="text-blue-500 hover:text-blue-700">Messages</a></li>
            <li><a href="../actions/logout_action.php">Logout</a></li>
        </ul>
    </nav>

    <!-- View Cart button at the top-right corner -->
    <a href="cart.php">
        <button class="viewCartBtn">View Cart</button>
    </a>

     <!-- Payment form container -->
     <form name="paymentForm" id="paymentForm">
        <div class="grid-container">
            <div class="grid-item"><label for="email">Email Address:</label></div>
            <div class="grid-item"><input type="email" id="email" name="email" placeholder="Enter your email" required></div>

            <div class="grid-item"><label for="fname">First Name:</label></div>
            <div class="grid-item"><input type="text" id="fname" name="fname" placeholder="Enter your first name" required></div>

            <div class="grid-item"><label for="lname">Last Name:</label></div>
            <div class="grid-item"><input type="text" id="lname" name="lname" placeholder="Enter your last name" required></div>

            <div class="grid-item"><label for="amount">Amount to Pay:</label>
            <div class="grid-item"><input type="tel" id="amount" name="amount" placeholder="Enter amount to be paid" required></div>

            <br>

            <div class="grid-item" colspan="2">
                <button type="submit" name="submit" onclick="payWithPaystack()"><b>Confirm Payment</b></button>
            </div>
        </div>
    </form>

    <!-- External JS scripts -->
    <script src="../js/pay.js"></script>
    <script src="https://js.paystack.co/v1/inline.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>


</body>

</html>
