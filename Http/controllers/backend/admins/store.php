<?php

use Core\Database;
use Core\App;
    

$db = App::resolve(Database::class);
$errors = [];
$admin_id = $_POST['admin_id'] ?? null;
$adminName = $_POST['adminName'] ?? null;
$user_id = $_POST['user_id'] ?? null;




if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($adminName)) {
        $errors[] = 'Admin name is required.';
    }

    if (empty($user_id)) {
        $errors[] = 'User ID is required.';
    }

    //insert into admin table
    if (empty($admin_id)) {
        $db->query('INSERT into admin (admin_name, user_id) values (:admin_name, :user_id)', [
            'admin_name' => $adminName,
            'user_id' => $user_id,
        ]);

        $db->query('UPDATE user SET user_type = :user_type WHERE user_id = :user_id', [
            'user_type' => '0',
            'user_id' => $user_id,
        ]);

        // $db->query('UPDATE user SET user_type = :user_type, username = :username WHERE user_id = :user_id', [
        //     'user_type' => '0',
        //     'username' => $adminName,
        //     'user_id' => $user_id,
        // ]);

        redirect('/admin/admin');
    } else {
        $errors[] = 'Admin already exists.';
        redirect('/views_admin/admins/add.view.php');
    }

}
