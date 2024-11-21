<?php
$serviceID = isset($_GET['serviceID']) ? $_GET['serviceID'] : null;

if (!$serviceID) {
    echo "No service ID provided.";
    exit;
}

include ('../controllers/service_controller.php');
$service = getOneServiceController($serviceID);
$allservices = getServicesController();

if (!$service) {
    echo "Service not found.";
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Service</title>
    <link rel="stylesheet" href="../css/services.css">
</head>
<body>
    <h1>Edit Service</h1>

    <form id="editServiceForm" method="POST" action="../actions/edit_service_action.php">
        <!-- Hidden input to store service ID -->
        <input type="hidden" name="service_id" value="<?php echo htmlspecialchars($service['service_id']); ?>">

        <!-- Service Name -->
        <label for="editServiceName">Service Name:</label>
        <input type="text" name="service_name" id="editServiceName" value="<?php echo htmlspecialchars($service['service_name']); ?>" required>

        <!-- Service Category -->
        <label for="editServiceCategory">Service Category:</label>
        <select id="editServiceCategory" name="service_category" required>
        <option value="<?php echo htmlspecialchars($service['service_category']); ?>">
            <?php echo htmlspecialchars($service['cat_name']); ?>
        </option>            
        <?php
            // // Fetch categories
            // include ('../controllers/categories_controller.php');
            // $categories = getCategoriesController();

            // if ($categories !== null) {
            //     foreach ($categories as $category) {
            //         // Set selected attribute for the current service category
            //         $selected = ($category['cat_id'] == $service_category) ? 'selected' : '';
            //         echo "<option value='{$category['cat_id']}' $selected>{$category['cat_name']}</option>";
            //     }
            // } else {
            //     echo "<option value=''>No categories available</option>";
            // }
        ?>
        </select>

        <!-- Service Price -->
        <label for="editServicePrice">Price:</label>
        <input type="number" name="service_price" id="editServicePrice" value="<?php echo htmlspecialchars($service['service_price']); ?>" required step="0.01">

        <!-- Service Description -->
        <label for="editServiceDesc">Description:</label>
        <textarea name="service_desc" id="editServiceDesc" required><?php echo htmlspecialchars($service['service_desc']); ?></textarea>

        <!-- Service Keywords -->
        <label for="editServiceKeywords">Keywords:</label>
        <input type="text" name="service_keywords" id="editServiceKeywords" value="<?php echo htmlspecialchars($service['service_keywords']); ?>" required>

        <!-- Submit button -->
        <button type="submit" name="action" value="update">Update Service</button>
    </form>

    <a href="services.php">Back to Services</a> <!-- Link to go back to the services page -->
</body>
</html>
