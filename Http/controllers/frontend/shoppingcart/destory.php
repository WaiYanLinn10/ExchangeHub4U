<?php

use Core\App;
use Core\Session;
use Core\Cart;

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !Session::has('id') || !isset($_POST['id'])) {
    redirect('/cart');
    exit;
}

$cart = App::resolve(Cart::class);
$cartProductId = (int) $_POST['id'];

if ($cart->removeFromCart($cartProductId)) {
    Session::flash('message', ['success', 'Removed from cart']);
} else {
    Session::flash('message', ['error', 'Failed to remove item']);
}

redirect('/cart');
exit;
