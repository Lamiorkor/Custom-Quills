<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Custom Quills - Homepage</title>
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
                <li><a href="../customer_view/customer_services.php" class="text-blue-500 hover:text-blue-700">Services</a></li>
                <li><a href="../customer_view/customer_contact.php" class="text-blue-500 hover:text-blue-700">Contact</a></li>
                <?php if(isset($_SESSION['user_role'])) { ?>
                <li><a href="../actions/logout_action.php" class="text-blue-500 hover:text-blue-700">Logout</a></li>
                <?php } else {?>
                <li><a href="login.php" class="text-blue-500 hover:text-blue-700">Login</a></li>
                <li><a href="register.php" class="text-blue-500 hover:text-blue-700">Register</a></li>
                <?php }?>
            </ul>
        </div>
    </nav>

    <!-- View Cart Button -->
    <?php if (isset($_SESSION['user_id'])) { ?>
        <div class="fixed top-0 right-0 m-4">
            <a href="cart.php">
                <button class="bg-green-500 text-white px-4 py-2 rounded-full shadow-md hover:bg-green-700">View Cart</button>
            </a>
        </div>
    <?php } ?>

    <!-- Main Content Section -->
    <main class="max-w-7xl mx-auto px-6 py-10 flex-1">
        <div class="text-center">
            <h3 class="text-2xl font-semibold">Welcome to Custom Quills!</h3>
            <p class="mt-4 text-lg text-gray-700">Feel free to explore our services <a href="customer_services.php" class="text-blue-500 hover:underline">here</a>.</p>
        </div>

        <!-- Featured Poems Section -->
        <section class="mt-10">
            <h4 class="text-xl font-semibold text-center mb-6">Our Custom Poems</h4>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Custom Poem 1 -->
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h5 class="text-lg font-semibold text-blue-500">Love and Hope</h5>
                    <p class="mt-4 text-gray-600 italic">"In every heart, there blooms a love, a flame that grows, with stars above."</p>
                    <p class="mt-4 text-gray-700">A poem that captures the eternal dance of love and hope, flowing through time and space.</p>
                </div>

                <!-- Custom Poem 2 -->
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h5 class="text-lg font-semibold text-blue-500">Dreams Beyond</h5>
                    <p class="mt-4 text-gray-600 italic">"Dreams that rise, like birds in flight, beyond the clouds, into the light."</p>
                    <p class="mt-4 text-gray-700">A poetic journey through the realm of dreams, soaring beyond the skies and into endless possibilities.</p>
                </div>

                <!-- Custom Poem 3 -->
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h5 class="text-lg font-semibold text-blue-500">Whispers of the Past</h5>
                    <p class="mt-4 text-gray-600 italic">"Whispers of the past, like winds so mild, tell the tales of the forgotten child."</p>
                    <p class="mt-4 text-gray-700">This poem brings to life the forgotten stories of time, hidden in the whispers of the past.</p>
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
