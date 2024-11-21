<?php
// Include the category class
include("../classes/category_class.php");

function addCategoryController($catName) {
    // Create an instance of the Category class
    $newCat = new Category();

    // Return the addCategory method
    return $newCat->addCategory($catName);
}

function deleteCategoryController($catID) {
    $category = new Category();

    // Return the deleteCategory method
    return $category->deleteCategory($catID);
}

function getCategoriesController() {
    // Create an instance of the Category class
    $categories = new Category();

    // Return the getCategories method
    return $categories->getCategories();
}

?>