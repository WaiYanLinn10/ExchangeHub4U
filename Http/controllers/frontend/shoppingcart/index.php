<?php

use Core\App;
use Core\Database;
use Core\Cart;
use Core\Session;

$db = App::resolve(Database::class);
$cart = App::resolve(Cart::class);
$userId = Session::get('id'); 

$customer = $db->query("SELECT customer_id FROM customer WHERE user_id = ?", [$userId])->find();

$customerId = $customer['customer_id'] ?? null;

// dd($customerId);

if ($customerId) {
    $cartItems = $cart->getCartItems($customerId);
    $cartCount = $cart->getCartCount($customerId);
    $tempTotal = $cart->calculateTotal($cartItems);
} else {
    // No customer found, empty cart
    $cartItems = [];
    $cartCount = 0;
    $tempTotal = 0;
}

view("shoppingcart.view.php", [
    'heading'   => 'Shopping Cart',
    'cartItems' => $cartItems,
    'cartCount' => $cartCount,
    'tempTotal' => $tempTotal,
]);