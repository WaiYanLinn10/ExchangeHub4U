<?php

use Core\Wishlist;
use Core\Session;
use Core\App;
use Core\Database;

if (Session::has('id')) {

    // $wishlist = new Wishlist();
    $userId = Session::getInt('id');
    
    $db = App::resolve(Database::class);
    $wishlist = App::resolve(Wishlist::class);

    $customer = $db->query("SELECT customer_id FROM customer WHERE user_id = ?", [$userId])->find();
    $customerId = $customer['customer_id'];
    
    $wishlistResult = $wishlist->getWishlistItems($customerId);
    $wishlistCount = $wishlist->getWishlistCount($customerId);
    // dd($customerId);
    // dd($wishlistResult);
    // dd($wishlistCount);
} else {
    $wishlistResult = [];
    $wishlistCount = 0;
}


view("wishlist.view.php", [
    'heading' => 'Wishlist',
    'wishlistCount' => $wishlistCount,
    'wishlistItems' => $wishlistResult 
]);
