<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Custom Quills - Manage Writers</title>
    <link rel="stylesheet" href="../css/writers.css">
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

    <!-- Form to add a new writer -->
    <form action="../actions/add_writer_action.php" method="POST" id="brandForm">
        <label>Writer Name</label>
        <input type="text" id="writerName" name="writerName" placeholder="Enter writer's name" required>
        <label>Years of Experience</label>
        <input type="number" id="experience" name="experience" placeholder="Enter number of years of experience" required>
        <label>Speciality</label>
        <input type="text" id="speaciality" name="speciality" placeholder="Enter writer's specialities" required>
        <button type="submit" name="action" value="add">Add Writer</button>
    </form>

    <!-- Display the list of brands from the database -->
    <h3>Existing Writers</h3>
    <div id="writerList">
        <table>
            <thead>
                <tr>
                    <th>Writer Name</th>
                    <th>Years of Experience</th>
                    <th>Specialities</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require('../controllers/writer_controller.php'); // Include the controller

                // Get and display all writers using the controller
                $writers = getWritersController();
                if ($writers) {
                    foreach ($writers as $writer) {
                        echo "<tr>
                            <td>{$writer['writer_name']}</td>
                            <td>{$writer['years_of_experience']}</td>
                            <td>{$writer['speciality']}</td>
                            <td>
                                <form action='../actions/delete_writer_action.php' method='POST'>
                                    <input type='hidden' name='writerID' value='{$writer['writer_id']}'>
                                    <button type='submit' name='action' value='delete'>Delete</button>
                                </form>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No writers available</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>
