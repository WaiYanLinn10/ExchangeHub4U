<?php

use Core\Database;
use Core\App;
use Core\Session;

$db = App::resolve(Database::class);
// dd($_GET);
if (isset($_GET['id'])) {
    $productId = $_GET['id'];
    $productDetails = $db->query(
        'SELECT * FROM product AS p 
        JOIN category AS c ON p.category_id = c.category_id 
        JOIN brand AS b ON p.brand_id = b.brand_id 
        WHERE p.product_id = :product_id', ['product_id' => $productId])->find();
} else {
    Session::flash('fail', 'Invalid request.');
    redirect('/admin/product');
} 

view_admin("products/show.view.php", [
    'heading' => 'Product Details',
    'productDetails' => $productDetails,
    'errors' => [],

]);
