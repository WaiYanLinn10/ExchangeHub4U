<?php

use Core\App;
use Core\Database;
use Core\Session;


$db = App::resolve(Database::class);

$customer_name = $_POST['customerName'];
$customer_phone = $_POST['customerPhone'];
$customer_address = $_POST['customerAddress'];
$customer_id = (int) $_POST['id'];

$db->query('UPDATE customer SET customer_name = :customer_name, customer_phone = :customer_phone, customer_address = :customer_address WHERE customer_id = :customer_id', [
    'customer_name' => $customer_name,
    'customer_phone' => $customer_phone,
    'customer_address' => $customer_address,
    'customer_id' => $customer_id,
]);


Session::flash('success', 'Customer updated successfully.');
redirect('/admin/customer');