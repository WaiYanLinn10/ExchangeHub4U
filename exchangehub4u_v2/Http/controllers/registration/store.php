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
$user = $db->query('select * from user where email = :email', [
    'email' => $email
])->get();

if ($user) {
    header('location: /login');
    exit();
} else {
    $db->query('INSERT INTO user(username, email, password) VALUES(:username, :email, :password)', [
        'username' => $username,
        'email' => $email,
        'password' => password_hash($password, PASSWORD_BCRYPT)
    ]);

    
    $signedIn = (new Authenticator)->attempt($email, $password);
    // dd($_SESSION);
//     if($signedIn){
//         Session::put('id', $user['user_id']);
//         Session::put('profile', 'false');

//         dd($_SESSION['id']);
//         redirect('/account/create');
//         exit();
//     }
// }

    if($signedIn){
        $newUser = $db->query('SELECT * FROM user WHERE email = :email', [
            'email' => $email
        ])->find();
        
        if ($newUser) {
            Session::put('id', $newUser['user_id']);
        }
        
        Session::put('profile', 'false');

        // dd($_SESSION['id']);
        redirect('/account/create');
        exit();
    }
}
    

