<?php
// Include the necessary controllers
include('../controllers/categories_controller.php');

// Fetch categories for the dropdown
$categories = getCategoriesController();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Service</title>
    <link rel="stylesheet" href="../css/services.css">
</head>

<body>
    <h1>Add New Service</h1>
    <form id="addServiceForm" method="POST" action="../actions/add_service_action.php">
        <label for="serviceName">Service Name:</label>
        <input type="text" id="serviceName" name="serviceName" required>

        <label for="serviceCategory">Service Category:</label>
        <select id="serviceCategory" name="serviceCategory" required>
            <option value="">Select Category</option>
            <?php
            // Populate the dropdown with categories
            if ($categories !== null) {
                foreach ($categories as $category) {
                    echo "<option value='{$category['cat_id']}'>{$category['cat_name']}</option>";
                }
            } else {
                echo "<option value=''>No categories available</option>";
            }
            ?>
        </select>

        <label for="servicePrice">Price:</label>
        <input type="number" id="servicePrice" name="servicePrice" required step="0.01"> 

        <label for="serviceDesc">Description:</label>
        <textarea id="serviceDesc" name="serviceDesc" required></textarea>

        <label for="serviceKeywords">Keywords:</label>
        <input type="text" id="serviceKeywords" name="serviceKeywords" required>

        <button type="submit">Add Service</button>
    </form>

    <a href="services.php">Back to Services</a> <!-- Link to go back to the services page -->
</body>

</html>
