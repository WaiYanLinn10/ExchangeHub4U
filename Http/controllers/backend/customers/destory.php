<?php

use Core\App;
use Core\Database;
use Core\Session;


$db = App::resolve(Database::class);

$customer_id = (int) $_POST['customer_id'];

$db->query("DELETE FROM customer WHERE customer_id = ?", [$customer_id]);


Session::flash('success', 'Customer deleted successfully.');
redirect('/admin/customer');

