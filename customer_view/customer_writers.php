<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Custom Quills - View Writers</title>
    <link rel="stylesheet" href="../css/writers.css">
</head>

<body>
    <h1>Custom Quills</h1>
    <h2><i>Poetry made for you</i></h2>

    <!-- Navigation Bar -->
    <nav>
        <ul>
            <li><a href="customer_writers.php">Writers</a></li>
            <li><a href="customer_services.php">Services</a></li>
            <li><a href="customer_orders.php">Orders</a></li>
            <li><a href="customer_contact.php">Contact</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>

    <!-- View Cart button at the top-right corner -->
    <a href="cart.php">
        <button class="viewCartBtn">View Cart</button>
    </a>

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
                                <form action='../actions/book_writer_action.php' method='POST'>
                                    <input type='hidden' name='writerID' value='{$writer['writer_id']}'>
                                    <button type='submit' name='action' value='book'>Book</button>
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
