<?php

use Core\App;
use Core\Database;
use Core\Session;
// dd($_POST);

$db = App::resolve(Database::class);

$username = $_POST['userName'];
$email = $_POST['userEmail'];
$password = $_POST['password'];

if(!empty($password)) {
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    $db->query('UPDATE user SET username = :username, email = :email, password = :password WHERE user_id = :user_id', [
        'username' => $username,
        'email' => $email,
        'password' => $hashedPassword,
        'user_id' => $_POST['id']
    ]);

} else {
    $db->query('UPDATE user SET username = :username, email = :email WHERE user_id = :user_id', [
        'username' => $username,
        'email' => $email,
        'user_id' => $_POST['id']
    ]);

}


Session::flash('success', 'User Info updated successfully.');
redirect('/admin/user');