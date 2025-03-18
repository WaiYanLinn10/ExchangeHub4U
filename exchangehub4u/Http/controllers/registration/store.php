<?php

use Core\App;
use Core\Database;
use Core\Validator;
use Core\Authenticator; 

$db = App::resolve(Database::class);

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_pwd = $_POST['confirmPassword'];

$errors = [];
if (!Validator::string($username, 4,50)) {
    $errors['username'] = 'Username must have at least 4 characters';
 }
 
if (!Validator::email($email)) {
   $errors['email'] = 'Please provide a valid email address.';
}

if (!Validator::string($password, 7, 255)) {
    $errors['password'] = 'Please provide a password of at least seven characters.';
}

if ($password != $confirm_pwd) {
    $errors['confirmPassword'] = 'The passwords do not match';
}

if (! empty($errors)) {
    return view('registration/create.view.php', [
        'errors' => $errors
    ]);
}

$user = $db->query('select * from user where email = :email', [
    'email' => $email
])->find();

if ($user) {
    header('location: /');
    exit();
} else {
    $db->query('INSERT INTO user(username, email, password) VALUES(:username, :email, :password)', [
        'username' => $username,
        'email' => $email,
        'password' => password_hash($password, PASSWORD_BCRYPT)
    ]);

    $auth = new Authenticator();
    $auth->login($user);

    header('location: /');
    exit();
}
