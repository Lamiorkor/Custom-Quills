<?php
session_start();
$user_name = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : "Guest";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Custom Quills - Customer Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex flex-col min-h-screen bg-gray-100">

    <!-- Header Section -->
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

    <!-- View Cart Button -->
    <div class="fixed top-0 right-0 m-4">
        <a href="cart.php">
            <button class="bg-green-500 text-white px-4 py-2 rounded-full shadow-md hover:bg-green-700">View Cart</button>
        </a>
    </div>

    <!-- Main Content Section -->
    <main class="max-w-7xl mx-auto px-6 py-10 flex-1">
        <div class="text-center">
            <h3 class="text-2xl font-semibold">Welcome, <?php echo htmlspecialchars($user_name); ?>!</h3>
            <p class="mt-4 text-lg text-gray-700">Explore our services and find the perfect poem for any occasion.</p>
        </div>

        <!-- Quick Links Section -->
        <section class="mt-10">
            <h4 class="text-xl font-semibold text-center mb-6">Quick Links</h4>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Services Card -->
                <div class="bg-white shadow-md rounded-lg p-6 hover:shadow-lg transition">
                    <h5 class="text-lg font-semibold text-blue-500">Explore Services</h5>
                    <p class="mt-4 text-gray-600">Discover our range of poetry services tailored to your needs.</p>
                    <a href="customer_services.php" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">View Services</a>
                </div>

                <!-- Writers Card -->
                <div class="bg-white shadow-md rounded-lg p-6 hover:shadow-lg transition">
                    <h5 class="text-lg font-semibold text-blue-500">Meet Our Writers</h5>
                    <p class="mt-4 text-gray-600">Browse through our talented writers and request your favorite.</p>
                    <a href="customer_writers.php" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">View Writers</a>
                </div>

                <!-- Orders Card -->
                <div class="bg-white shadow-md rounded-lg p-6 hover:shadow-lg transition">
                    <h5 class="text-lg font-semibold text-blue-500">Track Your Orders</h5>
                    <p class="mt-4 text-gray-600">Stay updated on the status of your poetry orders.</p>
                    <a href="customer_orders.php" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">View Orders</a>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer Section -->
    <footer class="bg-blue-500 text-white py-6">
        <div class="container mx-auto px-6 flex justify-center items-center">
            <p>&copy; <?php echo date("Y"); ?> Custom Quills. All rights reserved.</p>
        </div>
    </footer>

</body>

</html>
