<?php
use Core\App;
use Core\Database;
use Core\Session;

$errors = [];

if (Session::has('id')) {
    // Resolve the database connection
    $db = App::resolve(Database::class);
    $userId = (int) Session::get('id');
    $result = $db->query('SELECT * FROM customer WHERE user_id = ?', [$userId]);

    // dd($result->get());


    $customerData = $result->get();
    $customerCount = count($customerData);
    
    // Handle the case where no customer is found and profile is false
    if ($customerCount == 0 && Session::get('profile') === 'false') {
        view("account/create.view.php", [
            'heading' => 'Set Up Your Profile',
        ]);
    } else {
        redirect('/');
    }
}