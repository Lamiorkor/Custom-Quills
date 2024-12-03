<?php
session_start();
require_once('../controllers/message_controller.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: ../view/login.php");
    exit();
}

$userID = $_SESSION['user_id'];


// Fetch customer contact messages
$contactMessages = getCustomerContactMessagesController($userID);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Messages - Custom Quills</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex flex-col min-h-screen bg-gray-100">
    <!-- Header -->
    <header class="bg-blue-500 text-white p-6 text-center">
        <h1 class="text-3xl font-bold">Custom Quills</h1>
        <h2 class="italic text-xl mt-2">My Messages</h2>
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

    <!-- User Profile Button -->
    <div class="fixed top-0 right-0 m-4">
        <?php if (isset($_SESSION['user_id'])) { ?>
            <a href="customer_user_profile.php">
                <button class="bg-green-500 text-white px-4 py-2 rounded-full shadow-md hover:bg-blue-700">View Profile</button>
            </a>
        <?php } ?>
    </div>

    <!-- Messages Section -->
    <main class="max-w-3xl mx-auto py-10 px-6 bg-white shadow-md rounded-lg mt-6">
        <h2 class="text-2xl font-semibold mb-6 mt-12">Contact Form Messages</h2>
        <?php if ($contactMessages): ?>
            <?php foreach ($contactMessages as $message): ?>
                <div class="border-b border-gray-200 py-6">
                    <div class="flex justify-between items-center">
                        <p class="text-gray-800 font-semibold">Message:</p>
                        <p class="text-gray-500 text-sm"><?php echo htmlspecialchars($message['time_sent']); ?></p>
                    </div>
                    <p class="text-gray-800 mt-2"><?php echo nl2br(htmlspecialchars($message['message'])); ?></p>

                    <!-- If reply exists -->
                    <?php if (!empty($message['reply'])): ?>
                        <div class="mt-4">
                            <p class="text-gray-800 font-semibold">Reply:</p>
                            <p class="text-gray-600"><?php echo nl2br(htmlspecialchars($message['reply'])); ?></p>
                        </div>
                    <?php else: ?>
                        <p class="text-gray-500 italic mt-4">No reply yet.</p>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center text-gray-500 mt-6">No contact messages found.</p>
        <?php endif; ?>
    </main>

    <!-- Footer Section -->
    <footer class="bg-blue-500 text-white py-6 mt-auto">
        <div class="container mx-auto px-6 text-center">
            <p>&copy; <?php echo date("Y"); ?> Custom Quills. All rights reserved.</p>
        </div>
    </footer>
</body>

</html>
