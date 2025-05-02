<?php

use Core\App;
use Core\Database;
use Core\Session;

$db = App::resolve(Database::class);

$category_id = (int) $_POST['category_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['category_id'])) {
    
    $db->query("DELETE FROM category WHERE category_id = ?", [$category_id]);
    Session::flash('success', 'Category deleted successfully.');
    redirect('/admin/category');
} else {
    // dd("fail");
    Session::flash('fail', 'Invalid request.');
    redirect('/admin/category');
}