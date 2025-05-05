<?php

use Core\App;
use Core\Database;
use Core\Validator;
use Core\Session;
// dd($_POST);

$db = App::resolve(Database::class);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_POST['username']) || empty($_POST['email']) || empty($_POST['password'])) {
        $errors[] = 'The data cannot be empty.';
    } else {

        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];


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

        $exitingUser = $db->query("SELECT * FROM user WHERE email = :email", [
            'email' => $email
        ])->find();
        if ($exitingUser) {
            $errors[] = 'This email is already registered.';
            redirect('/admin/user');
            // echo "Existing user";
        } else {
            $db->query("INSERT INTO user (username, email, password) VALUES (:username, :email, :password)", [
                'username' => $username,
                'email' => $email,
                'password' => password_hash($password, PASSWORD_BCRYPT)
            ]);
            
            Session::flash('success', 'New user added successfully.');
            redirect('/admin/user');
            exit;
            // echo "Successfully added user";
        }

    }
}

