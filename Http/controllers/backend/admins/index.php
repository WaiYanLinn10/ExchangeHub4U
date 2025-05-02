<?php

use Core\Database;
use Core\App;

$db = App::resolve(Database::class);



$users = $db->query(
    'SELECT * FROM user 
    ORDER BY user_id DESC')->get();

//join user and admin table and select all columns from both tables
$admins = $db->query(
    'SELECT a.*, u.* 
    FROM admin a 
    JOIN user u ON a.user_id = u.user_id 
    ORDER BY a.admin_id ASC')->get();


view_admin("admins/index.view.php", [
    'heading' => 'Manage Admin Accounts',
    'admins' => $admins,
    'users' => $users,  
    'errors' => [],
]);
