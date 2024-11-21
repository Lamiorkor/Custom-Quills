<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Custom Quills - Manage Services</title>
    <link rel="stylesheet" href="../css/services.css"> <!-- External CSS file -->
</head>

<body>
    <h1>Custom Quills</h1>
    <h2><i>Poetry made for you</i></h2>

    <!-- Navigation Bar -->
    <nav>
        <ul>
            <li><a href="writers.php">Brands</a></li>
            <li><a href="services.php">Services</a></li>
            <li><a href="categories.php">Categories</a></li>
            <li><a href="orders.php">Orders</a></li>
            <li><a href="customers.php">Customers</a></li>
            <li><a href="contact.php">Contact</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>

    <!-- View Cart button at the top-right corner -->
    <a href="cart.php">
        <button class="viewCartBtn">View Cart</button>
    </a>

    <!-- Display the list of services from the database -->
    <h3>Existing Services</h3>
    <div id="serviceList">
        <table>
            <thead>
                <tr>
                    <th>Service Name</th>
                    <th>Service Category</th>
                    <th>Service Price</th>
                    <th>Service Description</th>
                    <th>Service Keywords</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include ('../controllers/service_controller.php');
                $services = getServicesController();

                // Check if services are returned
                if (!empty($services)) {
                    // Loop through each service and display it in a table row
                    foreach ($services as $service) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($service['service_name']) . "</td>";
                        echo "<td>" . htmlspecialchars($service['cat_name']) . "</td>";
                        echo "<td>" . htmlspecialchars($service['service_price']) . "</td>";
                        echo "<td>" . htmlspecialchars($service['service_desc']) . "</td>";
                        echo "<td>" . htmlspecialchars($service['service_keywords']) . "</td>";
                        echo "<td>
                              <form action='edit_service.php' method='GET' style='display:inline;'>
                                <input type='hidden' name='serviceID' value='{$service['service_id']}'>
                                <button type='submit' class='edit-btn' id='edit-btn'>Edit</button>
                            </form>
                            <form action='../actions/delete_service_action.php' method='POST' style='display:inline;'>
                                <input type='hidden' name='serviceID' value='{$service['service_id']}'>
                                <button type='submit' name='action' value='delete'>Delete</button>
                            </form>
                            <form action='../actions/add_to_cart_action.php' method='POST' style='display:inline;'>
                                <input type='hidden' name='serviceID' value='{$service['service_id']}'>
                                <button type='submit' class='addCartBtn'>
                                    <img src='../images/cart_icon.png' alt='Add to Cart'>
                                </button>
                            </form>
                            </td>";
                        echo "</tr>";
                    }
                } else {
                    // Display a message if no services are available
                    echo "<tr><td colspan='6'>No services found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Button to go to the Add New Service page -->
    <form action="add_service.php" method="GET">
        <button type="submit" class="addServiceBtn" id="addServiceBtn">Add New Service</button>
    </form>

</body>
</html>
