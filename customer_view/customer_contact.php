<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Custom Quills</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex flex-col min-h-screen bg-gray-100">

    <!-- Header -->
    <header class="bg-blue-500 text-white p-6 text-center">
        <h1 class="text-3xl font-bold">Custom Quills</h1>
        <h2 class="italic text-xl mt-2">Poetry made for you</h2>
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

    <!-- Contact Form -->
    <main class="max-w-3xl mx-auto py-10 px-6 flex-1 bg-white shadow-md rounded-lg">
        <h2 class="text-2xl font-semibold mb-6 text-center">Get in Touch</h2>
        <form action="../actions/contact_action.php" method="POST" class="space-y-6">
            <div>
                <label for="name" class="block text-gray-700 font-semibold">Your Name:</label>
                <input type="text" id="name" name="name" class="w-full border border-gray-300 rounded-lg p-2" required>
            </div>
            <div>
                <label for="email" class="block text-gray-700 font-semibold">Your Email:</label>
                <input type="email" id="email" name="email" class="w-full border border-gray-300 rounded-lg p-2" required>
            </div>
            <div>
                <label for="message" class="block text-gray-700 font-semibold">Message:</label>
                <textarea id="message" name="message" rows="5" class="w-full border border-gray-300 rounded-lg p-2" required></textarea>
            </div>
            <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600">
                Send Message
            </button>
        </form>
    </main>

    <!-- Footer -->
    <footer class="bg-blue-500 text-white py-4 text-center">
        <p>&copy; <?php echo date("Y"); ?> Custom Quills. All rights reserved.</p>
    </footer>

</body>

</html>
