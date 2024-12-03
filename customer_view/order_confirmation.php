<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include('../controllers/order_controller.php');
include('../controllers/payment_controller.php');

// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../view/login.php");
    exit();
}

// Fetch order ID and customer details
$order_id = $_GET['order_id'];
$user_id = $_SESSION['user_id'];
$user_email = $_SESSION['user_email'];
$user_name = $_SESSION['user_name'];

// Fetch order details
$order = getOrderDetailsController($order_id);
$total_amount = $order['total_amount'];
$currency = "GHS"; 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Custom Quills - Checkout</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex flex-col min-h-screen bg-gray-100">

    <!-- Header Section -->
    <header class="bg-blue-500 text-white p-6 text-center">
        <h1 class="text-3xl font-bold">Custom Quills</h1>
        <h2 class="italic text-xl mt-2">Order Confirmation</h2>
    </header>

    <!-- Navigation Bar -->
    <nav class="bg-white shadow-md">
        <div class="max-w-7xl mx-auto px-6 py-3">
            <ul class="flex justify-center space-x-6">
                <li><a href="customer_services.php" class="text-blue-500 hover:text-blue-700">Services</a></li>
                <li><a href="customer_writers.php" class="text-blue-500 hover:text-blue-700">Writers</a></li>
                <li><a href="customer_orders.php" class="text-blue-500 hover:text-blue-700">Orders</a></li>
                <li><a href="customer_contact.php" class="text-blue-500 hover:text-blue-700">Contact</a></li>
                <li><a href="customer_messages.php" class="text-blue-500 hover:text-blue-700">Messages</a></li>
                <li><a href="../actions/logout_action.php" class="text-blue-500 hover:text-blue-700">Logout</a></li>
            </ul>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="max-w-3xl mx-auto py-10 px-6 bg-white shadow-md rounded-lg">
        <h2 class="text-xl font-semibold mb-6">Confirm Your Order</h2>
        <form id="paymentForm">
            <div class="grid gap-6 mb-6">
                <!-- Customer Details -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Full Name:</label>
                    <input type="text" value="<?php echo htmlspecialchars($user_name); ?>" class="w-full border-gray-300 rounded-lg p-2 bg-gray-100" readonly>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Email Address:</label>
                    <input type="email" id="email" value="<?php echo htmlspecialchars($user_email); ?>" class="w-full border-gray-300 rounded-lg p-2 bg-gray-100" readonly>
                </div>

                <!-- Order Details -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Order ID:</label>
                    <input type="text" value="<?php echo htmlspecialchars($order_id); ?>" class="w-full border-gray-300 rounded-lg p-2 bg-gray-100" readonly>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Total Amount:</label>
                    <input type="text" id="amount" value="<?php echo htmlspecialchars($total_amount); ?>" class="w-full border-gray-300 rounded-lg p-2 bg-gray-100" readonly>
                </div>
            </div>

            <div>
                <button type="button" onclick="payWithPaystack()" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-700">Pay GHS <?php echo number_format($total_amount, 2); ?></button>
            </div>
        </form>
    </main>

    <!-- Footer -->
    <footer class="bg-blue-500 text-white py-6 text-center">
        <p>&copy; <?php echo date("Y"); ?> Custom Quills. All rights reserved.</p>
    </footer>

    <script src="https://js.paystack.co/v1/inline.js"></script>
    <script>
        function payWithPaystack() {
            const email = document.getElementById('email').value;
            const amount = document.getElementById('amount').value * 100;
            const orderId = "<?php echo htmlspecialchars($order_id); ?>";

            const handler = PaystackPop.setup({
                key: 'pk_test_0682d8859d7f3a8b1d81e362dbcd27ca1ecbb0d7',
                email: email,
                amount: amount,
                currency: 'GHS',
                ref: 'QW-' + Math.floor(Math.random() * 1000000000),
                callback: function(response) {
                    fetch("../actions/checkout_process.php", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json"
                        },
                        body: JSON.stringify({
                            reference: response.reference,
                            order_id: orderId
                        })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.status === "success") {
                            alert("Payment successful! Redirecting to orders...");
                            window.location.href = "customer_orders.php";
                        } else {
                            alert("Payment verification failed. Please try again.");
                        }
                    })
                    .catch(error => {
                        console.error("Error:", error);
                        alert("An error occurred. Please try again.");
                    });
                },
                onClose: function() {
                    alert("Transaction was not completed.");
                }
            });

            handler.openIframe();
        }
    </script>
</body>

</html>
