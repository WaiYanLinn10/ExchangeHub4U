<?php

use Core\Session;
use Core\Database;
use Core\App;
// dd($_SESSION);

$db = App::resolve(Database::class);
$userId = (int) Session::get('id');

// Check if a customer with this user ID exists
$customer = $db->query('SELECT * FROM customer WHERE user_id = ?', [$userId])->find();


// if (Session::has('id') && Session::get('profile') == 'false') { 
//     redirect('/account/create');
// }else{

if (Session::has('id') && !$customer){
    redirect('/account/create');
}else{
    $result = $db->query(
        'SELECT * FROM customer c INNER JOIN user u ON c.user_id = u.user_id WHERE c.user_id = :id',
         ['id' => $userId]
     )->find();

     // dd($customer);
    // Check if the customer has an order
    // $order = $db->query('SELECT * FROM `order` WHERE customer_id = ?', [$customer['customer_id']])->find();

    // dd($order);

    $order = $db->query('SELECT o.order_id, o.order_date, p.total_amount, o.delivered
    FROM `order` AS o
    JOIN payment AS p ON o.order_id = p.order_id
    WHERE o.customer_id = ?', [$customer['customer_id']])->get();

    // dd($order);

    $faq = $db->query('SELECT * FROM faq
        WHERE customer_id = ?', [$customer['customer_id']])->get();


     
    // dd($result);


        view("account/index.view.php", [
        'heading' => 'My Account',
        'user' => $result,
        'order' => $order,
        'faq' => $faq,
        'errors' => [],
    ]);
}


