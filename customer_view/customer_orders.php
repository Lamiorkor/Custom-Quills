<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Custom Quills - View Orders</title>
    <link rel="stylesheet" href="../css/orders.css">
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
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>

    <!-- View Cart button at the top-right corner -->
    <a href="cart.php">
        <button class="viewCartBtn">View Cart</button>
    </a>

    <!-- Display the list of orders from the database -->
    <h3>Orders</h3>
    <div id="orderList">
        <table>
            <thead>
                <tr>
                    <th>Invoice Number</th>
                    <th>Order Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require('../controllers/order_controller.php'); // Include the controller

                // Get and display all orders using the controller
                $orders = getOrdersController();
                if ($orders) {
                    foreach ($orders as $order) {
                        echo "<tr>
                            <td>{$order['invoice_no']}</td>
                            <td>{$order['order_date']}</td>
                            <td>{$order['order_status']}</td>
                            <td>
                                <form action='../actions/delete_order_action.php' method='POST'>
                                    <input type='hidden' name='orderID' value='{$order['order_id']}'>
                                    <button type='submit' name='action' value='delete'>Delete</button>
                                </form>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No orders available</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>
