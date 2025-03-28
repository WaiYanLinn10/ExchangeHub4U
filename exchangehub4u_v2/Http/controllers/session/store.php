<?php

use Core\Authenticator;
use Http\Forms\LoginForm;
use Core\Database;
use Core\Session;
use Core\App;

// First, validate the form data using the LoginForm class
$form = LoginForm::validate($attributes = [
    'email' => $_POST['email'],
    'password' => $_POST['password']
]);

// Check if the form is valid (You can adjust this based on your validation logic)
if ($form->failed()) {
    // Handle the case where the form validation failed (maybe return errors to the user)
    Session::flash('message', ['fail', 'Please fill out all fields correctly.']);
    redirect('/login');
}

// Attempt to log the user in using the Authenticator class
$signedIn = (new Authenticator)->attempt(
    $attributes['email'], $attributes['password']);


    
// if (!$signedIn) {
//     $form->error(
//         'email', 'No matching account found for that email address and password.'
//     )->throw();
// }else{
    
//         Session::put('id', $user['user_id']);
//         Session::put('profile', 'false'); 
//         redirect('/account/create');

// }




if ($signedIn) {

    $user = App::resolve(Database::class)->query("SELECT * FROM user WHERE email = :email", [
        'email' => $attributes['email']
    ])->find();

    if ($user) {

        Session::put('id', $user['user_id']);
        Session::put('profile', 'false'); 
        // dd($_SESSION);
        redirect('/account/create'); 
    } 
} else {
    $form->error(
        'email', 'No matching account found for that email address and password.'
        )->throw();
}