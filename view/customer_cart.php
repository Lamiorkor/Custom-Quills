<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Custom Quills - View Cart</title>
    <link rel="stylesheet" href="../css/cart.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> 
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

    <!-- Display the items in the cart -->
    <h3>Services in Cart</h3>
    <div id="cartList">
        <form action="../actions/add_order_action.php" method="POST">
            <table>
                <thead>
                    <tr>
                        <th>Service Name</th>
                        <th>Quantity</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    require('../controllers/cart_controller.php'); // Include the controller

                    // Get and display all cart items using the controller
                    $cart_items = getCartItemsController();
                    if ($cart_items) {
                        foreach ($cart_items as $cart_item) {
                            echo "<tr>
                                <td>{$cart_item['service_name']}</td>
                                <td>
                                    <div class='quantity-controls'>
                                        <form action='../actions/update_cart_action.php' method='POST'>
                                            <input type='hidden' name='serviceID' value='{$cart_item['s_id']}'>
                                            <button type='submit' name='action' value='increase' class='qty-btn'>
                                                <img src='../images/plus_icon.png' alt='Add to Cart' class='qty-icon'>
                                            </button>
                                        </form>
                                        <span class='qty-value'>{$cart_item['qty']}</span>                                
                                        <form action='../actions/update_cart_action.php' method='POST'>
                                            <input type='hidden' name='serviceID' value='{$cart_item['s_id']}'>
                                            <button type='submit' name='action' value='decrease' class='qty-btn'>
                                                <img src='../images/minus_icon.png' alt='Remove from Cart' class='qty-icon'>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                                <td>
                                    <form action='../actions/delete_from_cart_action.php' method='POST'>
                                        <input type='hidden' name='serviceID' value='{$cart_item['s_id']}'>
                                        <button type='submit' name='action' value='delete'>Delete</button>
                                    </form>
                                </td>
                            </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3'>Your cart is empty.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>

            <br>

            <!-- Proceed to Checkout Button -->
            <div class="checkout-btn-container">
                <button class="checkout-btn" type="submit" name="submit">Proceed to Checkout</button>
            </div>
        </form>
    </div>
</body>

</html>
