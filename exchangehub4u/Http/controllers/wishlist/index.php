<?php

if (!empty($_SESSION['id'])) {
    $wishlist = new Wishlist($customerData['customer_id']);

    $wishlistResult = $wishlistManager->getWishlistItems();
    $wishlistCount = $wishlistManager->getWishlistCount();
} else {
    $wishlistCount = 0;
}

view("wishlist.view.php", [
    'heading' => 'Wishlist',
    'wishlistCount' => $wishlistCount
]);