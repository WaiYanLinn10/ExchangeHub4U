<?php

use Core\Session;
use Core\Database;
use Core\App;


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productId = $_POST['product_id'][0] ?? null;

    // dd($_POST['product_id']);

    $userId = Session::getInt('id');
    
    $db = App::resolve(Database::class);

    $customer = $db->query("SELECT customer_id FROM customer WHERE user_id = ?", [$userId])->find();

    if (!$customer) {
        Session::flash('message', ['fail', "Customer account not found."]);
        redirect('/account/create');
    }
    
    $customerId = $customer['customer_id'];


    // dd($customerId);
    if (!$customerId) {
        Session::flash('message', ['fail', "You need an account to add products to wishlist."]);
        redirect('product/?id=' . $productId);
    }


    // Check if the wishlist exists for the customer
    $wishlist = $db->query("SELECT wishlist_id FROM wishlist WHERE customer_id = ?", [$customerId])->find();


    if (!$wishlist) {
        // Create a new wishlist if not exists
        $db->query("INSERT INTO wishlist (customer_id) VALUES (?)", [$customerId]);
        $wishlistId = $db->lastInsertId();

        
    } else {
        $wishlistId = $wishlist['wishlist_id'];
    }

    // Check if the product is already in the wishlist
    $existing = $db->query("SELECT * FROM wishlist_product WHERE wishlist_id = ? AND product_id = ?", [$wishlistId, $productId])->find();

    if ($existing) {
        Session::flash('message', ['fail', "This product is already in your wishlist."]);
    } else {
        // Insert product into wishlist
        $db->query("INSERT INTO wishlist_product (wishlist_id, product_id) VALUES (?, ?)", [$wishlistId, $productId]);
        Session::flash('message', ['success', "Product added to wishlist!"]);
    }

    redirect('/product?id=' . $productId);
}

