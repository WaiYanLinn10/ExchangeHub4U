<?php

use Core\App;
use Core\Database;
use Core\Session;


$db = App::resolve(Database::class);

// dd($_POST);

$admin_name = $_POST['adminName'];
$email = $_POST['email'];
$username = $_POST['username'];
$admin_id = (int) $_POST['id'];
$user_id_result = $db->query("SELECT user_id FROM admin WHERE admin_id = ?", [$admin_id])->find();
$user_id = $user_id_result['user_id'];


$db->query('UPDATE admin SET admin_name = :admin_name WHERE admin_id = :admin_id', [
    'admin_name' => $admin_name,
    'admin_id' => $admin_id,
]);


$db->query('UPDATE user SET username = :username, email = :email WHERE user_id = :user_id', [
    'username' => $username,
    'email' => $email,
    'user_id' => $user_id,
]);

Session::flash('success', 'Admin updated successfully.');
redirect('/admin/admin');



