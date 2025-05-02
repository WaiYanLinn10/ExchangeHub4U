<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);
// dd($_GET);
$customerId = $_GET['id'];

if (!$customerId) {
    redirect('/admin/customers');
}else {

    $data = $db->query("SELECT * FROM customer c INNER JOIN user u ON c.user_id = u.user_id WHERE c.customer_id = :id", [
        'id' => $customerId
    ])->find();

}


view_admin("customers/show.view.php", [
    'heading' => 'Customer Details',
    'customer' => $data,
    'errors' => [],
]);