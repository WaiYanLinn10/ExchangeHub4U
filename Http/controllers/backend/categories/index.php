<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);


$categories = $db->query("SELECT * FROM category")->get();



view_admin("categories/index.view.php", [
    'heading' => 'Manage Categories',
    'categories' => $categories,
]);
