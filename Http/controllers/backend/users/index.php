<?php

use Core\Database;
use Core\App;

$db = App::resolve(Database::class);



$users = $db->query(
    'SELECT * FROM user')->get();



view_admin("users/index.view.php", [
    'heading' => 'Manage User',
    'errors' => [],
    'users' => $users,
]);
