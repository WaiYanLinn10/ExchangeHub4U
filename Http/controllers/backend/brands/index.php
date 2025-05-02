<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$brands = $db->query("SELECT * FROM brand")->get();



view_admin("brands/index.view.php", [
    'heading' => 'Manage Brands',
    'brands' => $brands,
]);
