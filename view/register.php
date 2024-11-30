<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Custom Quills - Sign Up</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-cover bg-center h-screen" style="background-image: url('../images/custom_quills_logo.png');">
    <div class="flex justify-center items-center h-full">
        <div class="bg-white shadow-lg rounded-lg p-8 w-96">
            <h2 class="text-2xl font-bold mb-4 text-center">Sign Up</h2>
            <p class="text-sm text-gray-600 mb-6 text-center">
                <i>Kindly enter the following information to register:</i>
            </p>

            <!-- Signup form -->
            <form action="../actions/register_action.php" name="signupForm" method="POST" id="signupForm">
                <!-- Name -->
                <label for="name" class="block text-gray-700 font-medium">Full Name:</label>
                <input type="text" id="name" name="name" placeholder="Enter your full name"
                    class="border border-gray-300 rounded w-full p-2 mb-4 focus:ring focus:ring-blue-300" required>

                <!-- Email -->
                <label for="email" class="block text-gray-700 font-medium">Email Address:</label>
                <input type="email" id="email" name="email" placeholder="Enter your email"
                    class="border border-gray-300 rounded w-full p-2 mb-4 focus:ring focus:ring-blue-300" required>

                <!-- Password -->
                <label for="password" class="block text-gray-700 font-medium">Password:</label>
                <input type="password" id="password" name="password" placeholder="Enter your password"
                    class="border border-gray-300 rounded w-full p-2 mb-4 focus:ring focus:ring-blue-300" required>

                <!-- Retype Password -->
                <label for="passwordRetype" class="block text-gray-700 font-medium">Retype Password:</label>
                <input type="password" id="passwordRetype" name="passwordRetype" placeholder="Re-enter your password"
                    class="border border-gray-300 rounded w-full p-2 mb-4 focus:ring focus:ring-blue-300" required>

                <!-- Requested Role -->
                <label for="role" class="block text-gray-700 font-medium">Requested Role:</label>
                <select id="role" name="role"
                    class="border border-gray-300 rounded w-full p-2 mb-4 focus:ring focus:ring-blue-300" required>
                    <option value=""> </option>
                    <option value="customer">Customer</option>
                    <option value="writer">Writer</option>
                    <option value="administrator">Administrator</option>
                </select>

                <!-- Country -->
                <label for="country" class="block text-gray-700 font-medium">Country:</label>
                <input type="text" id="country" name="country" placeholder="Enter your country"
                    class="border border-gray-300 rounded w-full p-2 mb-4 focus:ring focus:ring-blue-300" required>

                <!-- City -->
                <label for="city" class="block text-gray-700 font-medium">City:</label>
                <input type="text" id="city" name="city" placeholder="Enter your city"
                    class="border border-gray-300 rounded w-full p-2 mb-4 focus:ring focus:ring-blue-300" required>

                <!-- Phone Number -->
                <label for="contact" class="block text-gray-700 font-medium">Contact Number:</label>
                <input type="text" id="contact" name="contact" placeholder="e.g. +233890982765"
                    class="border border-gray-300 rounded w-full p-2 mb-6 focus:ring focus:ring-blue-300" required>

                <!-- Submit Button -->
                <button type="submit" name="register"
                    class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 w-full">
                    Sign Up
                </button>
            </form>

            <!-- Link to login page -->
            <p class="text-sm text-gray-600 mt-4 text-center">
                Already have an account? <a href="login.php" class="text-blue-500 hover:underline">Login here</a>
            </p>
        </div>
    </div>

    <!-- External JS script for validation -->
    <script src="../js/register.js"></script>

</body>

</html>