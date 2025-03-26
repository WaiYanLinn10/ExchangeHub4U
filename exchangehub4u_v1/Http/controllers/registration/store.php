<?php

use Core\App;
use Core\Database;
use Core\Validator;
use Core\Authenticator; 
use Core\Session;

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

$user = $db->query('SELECT * FROM user WHERE email = :email', [
    'email' => $email
])->find();

if ($user) {
    redirect('/');
    exit();
} 

// Insert new user into the database
$db->query('INSERT INTO user(username, email, password) VALUES(:username, :email, :password)', [
    'username' => $username,
    'email' => $email,
    'password' => password_hash($password, PASSWORD_BCRYPT)
]);

// Attempt to log the user in using the Authenticator class
$auth = new Authenticator();
$signedIn = $auth->attempt($email, $password);

// Check if authentication is successful
if ($signedIn) {
    // Retrieve the authenticated user data
    $user = $db->query("SELECT * FROM user WHERE email = :email", [
        'email' => $email
    ])->find();

    if ($user) {
        Session::put('id', $user['user_id']);
        Session::put('profile', 'false'); 

        redirect('/account/create'); // Redirect to profile setup
        exit();
    }
}

redirect('/');
exit();