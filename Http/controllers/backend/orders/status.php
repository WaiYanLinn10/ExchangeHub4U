<?php

use Core\App;
use Core\Database;
use Core\Session;

$db = App::resolve(Database::class);

$orderId = $_GET['id'] ?? null;
$current = $_GET['current'] ?? null;

if ($orderId) {
    $db->query("UPDATE `order` SET delivered = :delivered WHERE order_id = :id", [
        'delivered' => $current === '1' ? 0 : 1,
        'id' => $orderId
    ]);
    Session::flash('success', 'Order status updated successfully.');
} else {
    Session::flash('fail', 'Failed to update order status.');
}

redirect('/admin/order');