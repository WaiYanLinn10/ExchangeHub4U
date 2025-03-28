<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

// Get the product ID from the URL
$productId = $_GET['id'];

// dd($_GET['id']);

$query = 'SELECT * FROM product AS p 
          INNER JOIN category AS c 
          ON p.category_id = c.category_id 
          WHERE p.product_id = ?';

$productData = $db->query($query, [$productId])->find();

// dd($productData);

if (empty($productData)) {
    abort();
}

// Pass data to the view
view("product/index.view.php", [
    'heading' => 'Product',
    'productData' => $productData
]);