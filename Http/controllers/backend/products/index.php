<?php

use Core\Database;
use Core\App;

$db = App::resolve(Database::class);

$products = $db->query(
    'SELECT p.*, c.category_name, b.brand_name 
    FROM product p 
    JOIN category c ON p.category_id = c.category_id 
    JOIN brand b ON p.brand_id = b.brand_id 
    ORDER BY p.product_add_date ASC')->get();

$categories = $db->query("SELECT * FROM category")->get();
$brands = $db->query("SELECT * FROM brand")->get();


view_admin("products/index.view.php", [
    'heading' => 'Manage Products',
    'products' => $products,
    'categories' => $categories,
    'brands' => $brands,
    'errors' => [],
]);
