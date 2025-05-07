<?php

use Core\App;
use Core\Database;
use Core\Session;
use Core\Cart;

$db = App::resolve(Database::class);
$cart = App::resolve(Cart::class);

// Ensure request is a POST request and user is logged in
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !Session::has('id') || !isset($_POST['id'])) {
    Session::flash('message', ['fail', 'Invalid request.']);
    redirect('/shop');
}

$userId = (int) Session::get('id');
$productId = (int) $_POST['id'];
$quantity = (int) ($_POST['quantity'] ?? 1);
$wishlistId = isset($_POST['wishlist']) && !empty($_POST['wishlist']) ? (int) $_POST['wishlist'] : null;

// Fetch product details from the database
$product = $db->query("SELECT * FROM product WHERE product_id = ?", [$productId])->find();
if (!$product || $product['product_quantity'] <= 0) {
    Session::flash('message', ['fail', 'This product is currently out of stock.']);
    redirect('/shop');
}

// Fetch customer details
$customer = $db->query("SELECT * FROM customer WHERE user_id = ?", [$userId])->find();
if (!$customer) {
    Session::flash('message', ['fail', 'Customer not found.']);
    redirect('/account/create');
}

$customerId = $customer['customer_id'];

// Fetch or create shopping cart
$cartData = $cart->getCartByCustomerId($customerId);
if (!$cartData) {
    $cartData = $cart->createCart($customerId);
}

$cartId = $cartData['shoppingcart_id'];

// Add product to cart
$productAdded = $cart->addProductToCart($cartId, $productId, $quantity);

if ($productAdded) {
    // Remove item from wishlist if it was added from wishlist
    if (!is_null($wishlistId)) {
        $cart->removeWishlistItem($wishlistId);
    }

    Session::flash('message', ['success', 'Product added to cart!']);
} else {
    Session::flash('message', ['fail', 'Product already in cart.']);
}

redirect("/product?id=$productId");
