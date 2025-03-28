<?php

use Core\Session;
use Core\Database;
use Core\App;

if (!Session::has('id')) {
    Session::flash('message', ['fail', "You don't have an account."]);
    redirect('index.php');
}

$db = App::resolve(Database::class);
$userId = Session::getInt('id');
$user = $db->query("SELECT * FROM user WHERE user_id = ?", [$userId])->find();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['oldPwd'], $_POST['newPwd'], $_POST['confirmPwd'])) {
    $oldPwd = $_POST['oldPwd'];
    $newPwd = $_POST['newPwd'];
    $confirmPwd = $_POST['confirmPwd'];

    if (!password_verify($oldPwd, $user['password'])) {
        Session::flash('message', ['fail', "Please make sure your old password matches."]);
        redirect('/account/index');
    }

    if ($newPwd !== $confirmPwd) {
        Session::flash('message', ['fail', "New password does not match with the confirm password."]);
        redirect('/account/index');
    }

    $hashedPassword = password_hash($newPwd, PASSWORD_BCRYPT);
    $db->query("UPDATE user SET password = ? WHERE user_id = ?", [$hashedPassword, $userId]);
    
    Session::flash('message', ['success', "Your password has been changed successfully."]);
    redirect('/account/index');
}
