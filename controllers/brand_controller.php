<?php
// Include the brand class
include("../classes/brand_class.php");

function addBrandController($brandName) {
    // Create an instance of the Brand class
    $newBrand = new Brand();

    // Return the addBrand method
    return $newBrand->addBrand($brandName);
}

function deleteBrandController($brandID) {
    $brand = new Brand();

    // Return the deleteBrand method
    return $brand->deleteBrand($brandID);
}

function getBrandsController() {
    // Create an instance of the Brand class
    $brands = new Brand();

    // Return the getBrands method
    return $brands->getBrands();
}
?>