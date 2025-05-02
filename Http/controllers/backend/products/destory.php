<?php

use Core\App;
use Core\Database;
use Core\Session;

$order_id = (int) $_POST['product_id'];


$db = App::resolve(Database::class);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
    // dd("success");
    $db->query("DELETE FROM product WHERE product_id = ?", [$order_id]);
    Session::flash('success', 'Product deleted successfully.');
    redirect('/admin/product');
} else {
    // dd("fail");
    Session::flash('fail', 'Invalid request.');
    redirect('/admin/product');
}