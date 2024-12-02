<?php
session_start();

require_once ('../controllers/writer_controller.php');
$writers = getWritersController();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Custom Quills - View Writers</title>
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

    <!-- Main Content Section -->
    <main class="max-w-7xl mx-auto px-6 py-10 flex-1">
        <h3 class="text-2xl font-semibold text-center">Meet Our Writers</h3>
        <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php
            if (!empty($writers)) {
                foreach ($writers as $writer) {
                    echo "
                    <div class='bg-white shadow-md rounded-lg p-6 hover:shadow-lg transition'>
                        <h5 class='text-lg font-semibold text-blue-500'>{$writer['writer_name']}</h5>
                        <p class='text-gray-600 mt-2'>Experience: {$writer['years_of_experience']} years</p>
                        <p class='text-gray-600'>Specialties: {$writer['speciality']}</p>
                        <form action='../actions/book_writer_action.php' method='POST' class='mt-4'>
                            <input type='hidden' name='writerID' value='{$writer['writer_id']}'>
                            <button type='submit' class='bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition'>Book Writer</button>
                        </form>
                    </div>";
                }
            } else {
                echo "<p class='text-center text-gray-500 col-span-3'>No writers found.</p>";
            }
            ?>
        </div>
    </main>

    <!-- Footer Section -->
    <footer class="bg-blue-500 text-white py-6">
        <div class="container mx-auto px-6 text-center">
            <p>&copy; <?php echo date("Y"); ?> Custom Quills. All rights reserved.</p>
        </div>
    </footer>

</body>

</html>
