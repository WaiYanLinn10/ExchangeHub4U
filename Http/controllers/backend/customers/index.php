<?php

use Core\Database;
use Core\App;

$db = App::resolve(Database::class);


$customers = $db->query(
    'SELECT user.*, customer.* 
    FROM user 
    INNER JOIN customer 
    ON user.user_id = customer.user_id 
    ORDER BY customer.created_time ASC'
)->get();


$users = $db->query(
    'SELECT * FROM user 
    ORDER BY user_id DESC')->get();

// $customers = $db->query(
//     'SELECT * FROM customer 
//     ORDER BY customer_id DESC')->get();


view_admin("customers/index.view.php", [
    'heading' => 'Manage Customers',
    'errors' => [],
    'customers' => $customers,
    'users' => $users,
]);
