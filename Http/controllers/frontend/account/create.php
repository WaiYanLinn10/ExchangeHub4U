<?php
use Core\App;
use Core\Database;
use Core\Session;

$db = App::resolve(Database::class);
$userId = (int) Session::get('id');

// Check if a customer with this user ID exists
$customer = $db->query('SELECT * FROM customer WHERE user_id = ?', [$userId])->find();
// dd($customer);

// if (!$customer && Session::get('profile') === 'false') {

if (Session::has('id') && !$customer){
    view("account/create.view.php", [
        'heading' => 'Set Up Your Profile',
    ]);
    exit();
}else{
    redirect('/');
}

