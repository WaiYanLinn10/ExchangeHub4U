<?php

use Core\Session;
use Core\Database;
use Core\App;
// dd($_SESSION);

$db = App::resolve(Database::class);
$userId = (int) Session::get('id');

// Check if a customer with this user ID exists
$customer = $db->query('SELECT * FROM customer WHERE user_id = ?', [$userId])->find();
// dd($customer);
$customer_name = $customer['customer_name'] ?? null;
$customer_phone = $customer['customer_phone'] ?? null;
$customer_address = $customer['customer_address'] ?? null;

if (Session::has('id') && !$customer){
    redirect('/account/create');
}else{
    $user = $db->query('SELECT * FROM user WHERE user_id = ?', [$userId])->find();


    // dd($order);

    $order = $db->query('SELECT o.order_id, o.order_date, p.total_amount, o.delivered
    FROM `order` AS o
    JOIN payment AS p ON o.order_id = p.order_id
    WHERE o.customer_id = ?', [$customer['customer_id']])->get();

    // dd($order);

    $faq = $db->query('SELECT * FROM faq
        WHERE customer_id = ?', [$customer['customer_id']])->get();



        view("account/index.view.php", [
        'heading' => 'My Account',
        'user' => $user,
        'customer_name' => $customer_name,
        'customer_phone' => $customer_phone,
        'customer_address' => $customer_address,
        'order' => $order,
        'faq' => $faq,
        'errors' => [],
    ]);
}


