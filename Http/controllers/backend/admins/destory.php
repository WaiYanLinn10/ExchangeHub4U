<?php

use Core\App;
use Core\Database;
use Core\Session;


$db = App::resolve(Database::class);
$admin_id = (int) $_POST['admin_id'];

// dd($admin_id);

$user_id_result = $db->query("SELECT user_id FROM admin WHERE admin_id = ?", [$admin_id])->find();
$user_id = $user_id_result['user_id'];

// dd($user_id);

$user = $db->query("SELECT * FROM user WHERE user_id = ?", [$user_id])->find();
// dd($user); 

$db->query('UPDATE user SET user_type = :user_type WHERE user_id = :user_id', [
    'user_type' => '1',
    'user_id' => $user_id,
]);

$db->query("DELETE FROM admin WHERE admin_id = ?", [$admin_id]);

Session::flash('success', 'Admin deleted successfully.');
redirect('/admin/admin');
