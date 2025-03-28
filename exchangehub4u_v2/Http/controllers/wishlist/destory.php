<?php

use Core\Session;
use Core\Database;
use Core\App;


if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !Session::has('id') || !isset($_POST['id'])) {

    redirect('/wishlist');

}

$userId = Session::getInt('id');
$wishlistProductId = (int)$_POST['id'];

$db = App::resolve(Database::class);

// Delete wishlist item
$deleted = $db->query('DELETE FROM wishlist_product WHERE wishlist_product_id = ?', [$wishlistProductId]);

Session::flash('message', $deleted ? ['success', "Removed from wishlist"] : ['danger', "Failed to remove item"]);

redirect('/wishlist'); 
