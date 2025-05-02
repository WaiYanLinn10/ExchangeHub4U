<?php

use Core\App;
use Core\Database;
use Core\Session;
use Core\Validator;

$db = App::resolve(Database::class);
$errors = [];

// dd(Session::get('id'));

// dd($_POST);
// Ensure user is logged in and profile needs setup
// if (!Session::has('id') || !Session::get('profile') === "false") {
//     redirect('/');
// }

// Validate required fields
if (!Validator::string($_POST['fullname'], 3, 100)) {
    $errors['fullname'] = 'Fullame must be between 3 and 100 characters.';
}

if (!Validator::integer($_POST['phonenum'], 10, 15)) {
    $errors['phonenum'] = 'Invalid phone number format.';
}

if (!Validator::string($_POST['address'], 5, 255)) {
    $errors['address'] = 'Address must be at least 5 characters.';
}


if (!empty($errors)) {
    // dd($errors);
    return view('account/create.view.php', [
        'heading' => 'Profile Setup',
        'errors' => $errors
    ]);
} else {
    // Insert customer profile into database
    $db->query(
        'INSERT INTO customer (customer_name, customer_address, customer_phone,  user_id)
        VALUES (:customer_name, :customer_address, :customer_phone,  :user_id)',
        [
            'customer_name' => $_POST['fullname'],
            'customer_phone' => $_POST['phonenum'],
            'customer_address' => $_POST['address'],
            'user_id' => Session::get('id')
        ]
    );

    // Mark profile as complete
    Session::put('message', ['success', 'Your profile has been set up successfully.']);
    // Session::put('profile', "true");

    redirect('/account/index');
    exit();
}
