<?php

use Core\Session;
use Core\Database;
use Core\App;

// if (!Session::has('id')) {
//     redirect('/login');
// }

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['full_name'], $_POST['phone'], $_POST['email'], $_POST['address'])) {
    $db = App::resolve(Database::class);
    
    $userId = Session::getInt('id');
    $fullName = $_POST['full_name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    
    // Update user email
    $db->query("UPDATE user SET email = ? WHERE user_id = ?", [$email, $userId]);
    
    // Update customer details
    $db->query("UPDATE customer SET customer_name = ?, customer_address = ?, customer_phone = ? WHERE user_id = ?", [$fullName, $address, $phone, $userId]);
    
    Session::flash('message', ['success', "Your personal information is up-to-date."]);
    redirect('/account/index');
} else {
    Session::flash('message', ['fail', "You didn't provide any information to update."]);
    redirect('/account/index');
}
