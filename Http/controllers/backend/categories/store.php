<?php

use Core\App;
use Core\Database;
use Core\Session;


// dd($_POST);

$db = App::resolve(Database::class);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_POST['categoryName'])) {
        Session::flash('fail', 'The new category data cannot be empty.');
        redirect('/admin/category');
        exit;
    }

    $category_name = $_POST['categoryName'];
    $category_description = $_POST['categoryDescription'];



    // Check if category name already exists
    $existing_category = $db->query("SELECT * FROM category WHERE category_name = :category_name", [
        'category_name' => $category_name,
    ])->find();

    if ($existing_category) {
        Session::flash('fail', 'Category name already exists. Please choose a different name.');
        redirect('/admin/category');
        exit;
    }
    // Insert new category into the database

    $db->query("INSERT INTO category (category_name, category_description) VALUES (:category_name, :category_description)", [
        'category_name' => $category_name,
        'category_description' => $category_description,
    ]);

    Session::flash('success', 'New category has been added successfully.');
    redirect('/admin/category');
    exit;
} else {
    Session::flash('fail', 'Invalid request method.');
    redirect('/admin/category');
    exit;
}