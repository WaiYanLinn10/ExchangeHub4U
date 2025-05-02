<?php

use Core\App;
use Core\Container;
use Core\Database;
use Core\Cart;
use Core\FAQ;
use Core\Wishlist;

$container = new Container();

$container->bind(Database::class, function () {
    $config = require base_path('config.php');
    return new Database($config['database']);
});

$container->bind(Cart::class, function () {
    return new Cart(App::resolve(Database::class));
});

$container->bind(Wishlist::class, function () {
    return new Wishlist(App::resolve(Database::class));
});

$container->bind(FAQ::class, function (): FAQ {
    return new FAQ(App::resolve(Database::class));
});

App::setContainer($container);
