<?php

$router->get('/', 'frontend/index.php');
$router->get('/about', 'frontend/about.php');
$router->get('/contact', 'frontend/contact.php');
$router->get('/shop', 'frontend/shop.php');
$router->get('/faq','frontend/faq.php');

$router->get('/product','frontend/product/index.php');

$router->get('/register', 'frontend/registration/create.php')->only('guest');
$router->post('/register', 'frontend/registration/store.php')->only('guest');

$router->get('/login', 'frontend/session/create.php')->only('guest');
$router->post('/session', 'frontend/session/store.php')->only('guest');
$router->delete('/session', 'frontend/session/destroy.php')->only('auth');

$router->get('/account/index', 'frontend/account/index.php')->only('auth') ;
$router->get('/account/create', 'frontend/account/create.php')->only('auth');
$router->post('/account', 'frontend/account/store.php');
$router->patch('/account/update/info','frontend/account/update.info.php');
$router->patch('/account/update/pwd','frontend/account/update.pwd.php');
$router->delete('/account','frontend/account/destory.php');

$router->get('/cart', 'frontend/shoppingcart/index.php');
$router->post('/cart', 'frontend/shoppingcart/add.php');
$router->delete('/cart','frontend/shoppingcart/destory.php');

$router->get('/wishlist','frontend/wishlist/index.php');
$router->post('/wishlist', 'frontend/wishlist/add.php');
$router->delete('/wishlist', 'frontend/wishlist/destory.php'); 

$router->post('/checkout', 'frontend/checkout/index.php');
$router->post('/order', 'frontend/checkout/order_add.php');

$router->get('/admin', 'backend/index.php')->only('admin');

$router->get('/admin/order','backend/orders/index.php')->only('admin');
$router->get('/admin/order/show','backend/orders/show.php')->only('admin');
$router->delete('/admin/order','backend/orders/destory.php')->only('admin');
$router->get('/admin/order/status','backend/orders/status.php')->only('admin');

$router->get('/admin/product','backend/products/index.php')->only('admin');
$router->get('/admin/product/show','backend/products/show.php')->only('admin');
$router->post('/admin/product','backend/products/store.php')->only('admin');
$router->patch('/admin/product','backend/products/update.php')->only('admin');
$router->delete('/admin/product','backend/products/destory.php')->only('admin');

$router->get('/admin/admin','backend/admins/index.php')->only('admin');
$router->post('/admin/admin','backend/admins/store.php')->only('admin');
$router->patch('/admin/admin','backend/admins/update.php')->only('admin');
$router->delete('/admin/admin','backend/admins/destory.php')->only('admin');


$router->get('/admin/user','backend/users/index.php')->only('admin');
$router->post('/admin/user','backend/users/store.php')->only('admin');
$router->patch('/admin/user','backend/users/update.php')->only('admin');
$router->delete('/admin/user','backend/users/destory.php')->only('admin');

$router->get('/admin/customer','backend/customers/index.php')->only('admin');
$router->get('/admin/customer/show','backend/customers/show.php')->only('admin');
$router->post('/admin/customer','backend/customers/store.php')->only('admin');
$router->patch('/admin/customer','backend/customers/update.php')->only('admin');
$router->delete('/admin/customer','backend/customers/destory.php')->only('admin');

$router->get('/admin/brand','backend/brands/index.php')->only('admin');
$router->post('/admin/brand','backend/brands/store.php')->only('admin');
$router->patch('/admin/brand','backend/brands/update.php')->only('admin');
$router->delete('/admin/brand','backend/brands/destory.php')->only('admin');


$router->get('/admin/category','backend/categories/index.php')->only('admin');
$router->post('/admin/category','backend/categories/store.php')->only('admin');
$router->patch('/admin/category','backend/categories/update.php')->only('admin');
$router->delete('/admin/category','backend/categories/destory.php')->only('admin');


$router->get('/admin/faq','backend/faq/index.php')->only('admin');
$router->post('/admin/faq','backend/faq/store.php')->only('admin');
$router->patch('/admin/faq','backend/faq/update.php')->only('admin');
$router->delete('/admin/faq','backend/faq/destory.php')->only('admin');
$router->get('/admin/faq/status','backend/faq/status.php')->only('admin');




