<?php

use Core\Database;
use Core\App;
use Core\Session;
    

$db = App::resolve(Database::class);
// dd($_POST);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_POST['customerName']) || empty($_POST['user_id']) || empty($_POST['customerPhone']) || empty($_POST['customerAddress'])) {
        $errors[] = 'The new customer data cannot be empty.';
    } else {
        $customer_name = $_POST['customerName'];
        $customer_phone = $_POST['customerPhone'];
        $customer_address = $_POST['customerAddress'];
        $user_id = $_POST['user_id'];

        $existingCustomer = $db->query("SELECT * FROM customer WHERE customer_id = :id", [
            'id' => $user_id
        ])->find();
        
        if ($existingCustomer) {
            $errors[] = 'This email is already registered.';
            redirect('/admin/customer');
        } else {
            $db->query("INSERT INTO customer (customer_name, customer_phone, customer_address, user_id) VALUES (:name, :phone, :address, :user_id)", [
                'name' => $customer_name,
                'phone' => $customer_phone,
                'address' => $customer_address,
                'user_id' => $user_id
            ]);
            
            Session::flash('success', 'New customer added successfully.');
            redirect('/admin/customer');
            exit;
        }
    }
}