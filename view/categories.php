<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Custom Quills - Manage Categories</title>
    <link rel="stylesheet" href="../css/brands.css">
</head>

<body>
    <h1>Custom Quills</h1>
    <h2><i>Poetry made for you</i></h2>

    <!-- Navigation Bar -->
    <nav>
        <ul>
            <li><a href="writers.php">Writers</a></li>
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


    <!-- Form to add a new brand -->
    <form action="../actions/add_category_action.php" method="POST" id="categoryForm">
        <label>Category Name</label>
        <input type="text" id="catName" name="catName" placeholder="Enter category name" required>
        <button type="submit" name="action" value="add">Add Category</button>
    </form>

    <!-- Display the list of brands from the database -->
    <h3>Existing Categories</h3>
    <div id="categoryList">
        <table>
            <thead>
                <tr>
                    <th>Category Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require('../controllers/categories_controller.php'); // Include the controller

                // Get and display all brands using the controller
                $categories = getCategoriesController();
                if ($categories) {
                    foreach ($categories as $category) {
                        echo "<tr>
                            <td>{$category['cat_name']}</td>
                            <td>
                                <form action='../actions/delete_category_action.php' method='POST'>
                                    <input type='hidden' name='catID' value='{$category['cat_id']}'>
                                    <button type='submit' name='action' value='delete'>Delete</button>
                                </form>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='2'>No categories available</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>
