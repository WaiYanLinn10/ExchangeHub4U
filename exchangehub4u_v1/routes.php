<?php

$router->get('/', 'index.php');
$router->get('/about', 'about.php');
$router->get('/contact', 'contact.php');
$router->get('/shop', 'shop.php');

$router->get('/product','product/index.php');

$router->get('/register', 'registration/create.php')->only('guest');
$router->post('/register', 'registration/store.php')->only('guest');

$router->get('/login', 'session/create.php')->only('guest');
$router->post('/session', 'session/store.php')->only('guest');
$router->delete('/session', 'session/destroy.php')->only('auth');

$router->get('/account/index', 'account/index.php')->only('auth');
$router->get('/account/create','account/create.php')->only('auth');
$router->post('/account', 'account/store.php');
$router->patch('/account/update/info','account/update.info.php');
$router->patch('/account/update/pwd','account/update.pwd.php');
$router->delete('/account','account/destory.php');

$router->get('/cart', 'shoppingcart/index.php');
$router->post('/cart', 'shoppingcart/add.php');
$router->delete('/cart','shoppingcart/destory.php');

$router->get('/wishlist','wishlist/index.php');
$router->post('/wishlist', 'wishlist/add.php');
$router->delete('/wishlist', 'wishlist/destory.php'); 

$router->post('/checkout', 'checkout/index.php');


