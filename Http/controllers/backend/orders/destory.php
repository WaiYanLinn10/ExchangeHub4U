<?php

use Core\App;
use Core\Database;
use Core\Session;

$order_id = (int) $_POST['order_id'];

// dd($order_id);

$db = App::resolve(Database::class);

$user_id = Session::getInt('id');
// dd($user_id);

$admin = $db->query("SELECT * FROM admin WHERE user_id = ?", [$user_id])->find();
// dd($admin);
if (!$admin) {
    Session::flash('fail', 'Unauthorized access.');
    redirect('/admin/order');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_id'])) {
    // dd("success");
    $db->query("DELETE FROM `order` WHERE order_id = ?", [$order_id]);
    Session::flash('success', 'Order deleted successfully.');
    redirect('/admin/order');
} else {
    // dd("fail");
    Session::flash('fail', 'Invalid request.');
    redirect('/admin/order');
}