<?php

use Core\Session;
use Core\Database;
use Core\App;

// Check authentication
if (!Session::has('id')) {
    Session::flash('message', ['fail', 'You must be logged in.']);
    redirect('/login');
    exit;
}

$db = App::resolve(Database::class);
$userId = (int) Session::get('id');

$customer = $db->query('SELECT * FROM customer WHERE user_id = ?', [$userId])->find();

if (!$customer) {
    Session::flash('message', ['fail', 'Customer profile not found.']);
    redirect('/account');
    exit;
}

// Get order ID from URL
$orderId = $_GET['id'] ?? null;

if (!$orderId || !is_numeric($orderId)) {
    Session::flash('message', ['fail', 'Invalid order ID.']);
    redirect('/account');
    exit;
}

// Fetch order details securely with ownership check
$order = $db->query(
    'SELECT o.*, p.total_amount, pt.payment_type
     FROM `order` AS o
     JOIN payment AS p ON o.order_id = p.order_id
     JOIN payment_type AS pt ON p.payment_type_id = pt.payment_type_id
     WHERE o.order_id = ? AND o.customer_id = ?',
    [$orderId, $customer['customer_id']]
)->find();

if (!$order) {
    Session::flash('message', ['fail', 'Order not found or access denied.']);
    redirect('/account');
    exit;
}

// Fetch products associated with the order
$orderProducts = $db->query(
    'SELECT op.*, p.product_name, p.product_description, p.product_price
     FROM order_product AS op
     JOIN product AS p ON op.product_id = p.product_id
     WHERE op.order_id = ?',
    [$orderId]
)->get();

// dd($orderProducts);

// Render view
view("account/order.view.php", [
    'heading' => 'My Order',
    'order' => $order,
    'customer' => $customer,
    'orderProducts' => $orderProducts,
    'user' => $db->query('SELECT * FROM user WHERE user_id = ?', [$userId])->find(),
]);

