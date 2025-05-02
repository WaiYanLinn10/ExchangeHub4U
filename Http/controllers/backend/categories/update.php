<?php


use Core\App;
use Core\Database;  
use Core\Session;

$db = App::resolve(Database::class);
// dd($_POST);
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $category_id = $_POST['id'];
    $category_name = $_POST['categoryName'];
    $category_description = $_POST['categoryDescription'];



    // Update the category in the database
    $db->query("UPDATE category SET category_name = :category_name, category_description = :category_description WHERE category_id = :category_id", [
        'category_name' => $category_name,
        'category_description' => $category_description,
        'category_id' => $category_id,
    ]);

    Session::flash('success', 'Category updated successfully.');
    redirect('/admin/category');
} else {
    Session::flash('fail', 'Invalid request.');
    redirect('/admin/category');
}
