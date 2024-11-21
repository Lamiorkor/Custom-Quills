<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Custom Quills - Manage Orders</title>
    <link rel="stylesheet" href="../css/orders.css">
</head>

<body>
    <h1>Custom Quills</h1>
    <h2><i>Poetry made for you</i></h2>

    <!-- Navigation Bar -->
    <nav>
        <ul>
            <li><a href="writers.php">Brands</a></li>            <li><a href="services.php">Services</a></li>
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


    <!-- Form to add a new brand
    <form action="../actions/add_brand_action.php" method="POST" id="brandForm">
        <label>Brand Name</label>
        <input type="text" id="brandName" name="brandName" placeholder="Enter brand name" required>
        <button type="submit" name="action" value="add">Add Brand</button>
    </form> -->

    <!-- Display the list of brands from the database -->
    <h3>Customers</h3>
    <div id="customerList">
        <table>
            <thead>
                <tr>
                    <th>Order</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // require('../controllers/brand_controller.php'); // Include the controller

                // // Get and display all brands using the controller
                // $brands = getBrandsController();
                // if ($brands) {
                //     foreach ($brands as $brand) {
                //         echo "<tr>
                //             <td>{$brand['brand_name']}</td>
                //             <td>
                //                 <form action='../actions/delete_brand_action.php' method='POST'>
                //                     <input type='hidden' name='brandID' value='{$brand['brand_id']}'>
                //                     <button type='submit' name='action' value='delete'>Delete</button>
                //                 </form>
                //             </td>
                //         </tr>";
                //     }
                // } else {
                //     echo "<tr><td colspan='2'>No brands available</td></tr>";
                // }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>
