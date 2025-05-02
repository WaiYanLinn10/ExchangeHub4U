<?php
use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$latestProducts = $db->query(
    "SELECT * FROM product AS p JOIN brand AS b ON p.brand_id = b.brand_id ORDER BY p.product_id DESC LIMIT 4;"
    )->get();

$lastOrders = $db->query(
    "SELECT * FROM `order` AS o JOIN customer AS c ON o.customer_id = c.customer_id JOIN payment AS p ON o.order_id = p.order_id ORDER BY o.order_id DESC LIMIT 5;"
    )->get();

$totalProducts = $db->query("SELECT COUNT(*) AS total FROM product")->find()['total'];
$totalOrders = $db->query("SELECT COUNT(*) AS total FROM `order`")->find()['total'];
$totalCustomers = $db->query("SELECT COUNT(*) AS total FROM customer")->find()['total'];
$totalBrands = $db->query("SELECT COUNT(*) AS total FROM brand")->find()['total'];


view_admin("index.view.php", [
    'heading' => 'Dashboard',
    'latestProducts' => $latestProducts,
    'lastOrders' => $lastOrders,
    'totalProducts' => $totalProducts,
    'totalOrders' => $totalOrders,
    'totalCustomers' => $totalCustomers,
    'totalBrands' => $totalBrands,
]);
