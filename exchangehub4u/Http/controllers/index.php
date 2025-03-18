<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);


$latestProducts = $db->query('SELECT * FROM product ORDER BY product_id DESC LIMIT 6')->get();

view("index.view.php", [
    'heading' => 'Home',
    'latestProducts' => $latestProducts 
]);