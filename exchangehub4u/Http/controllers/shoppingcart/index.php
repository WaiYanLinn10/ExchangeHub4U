<?php

use Core\App;
use Core\Database;
use Core\Cart;

$db = App::resolve(Database::class);

$cart = new Cart($db);

if (!empty($_SESSION['id'])) {
    $customerId = $_SESSION['id'];
    $cartItems = $cart->getCartItems($customerId);
    $cartCount = $cart->getCartCount($customerId);
    $tempTotal = $cart->calculateTotal($cartItems);
} else {
    $cartCount = 0;
    $tempTotal = 0;
}

view("shoppingcart.view.php", [
    'heading' => 'Shopping Cart',
    'cartCount' => $cartCount,
    'tempTotal' => $tempTotal
]);
