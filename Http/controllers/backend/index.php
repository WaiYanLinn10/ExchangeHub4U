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


$totalSales = [];
$current = date("Y");
for ($i = 1; $i <= 12; $i++) {
    $sale = 0;
    $startDate = "$current-$i-01";
    $endDate = "$current-$i-31";

    // Use the Database class to execute the query
    $sql = "SELECT total_amount FROM payment WHERE payment_time BETWEEN :startDate AND :endDate";
    $params = ['startDate' => $startDate, 'endDate' => $endDate];
    $results = $db->query($sql, $params)->get();

    // Calculate the total sales for the month
    foreach ($results as $data) {
        $sale += $data['total_amount'];
    }

    array_push($totalSales, $sale);
}
$totalSales = json_encode($totalSales);
$totalOrders = $db->query("SELECT COUNT(*) AS total FROM `order`")->find()['total'];
$totalCustomers = $db->query("SELECT COUNT(*) AS total FROM customer")->find()['total'];



view_admin("index.view.php", [
    'heading' => 'Dashboard',
    'latestProducts' => $latestProducts,
    'lastOrders' => $lastOrders,
    'totalSales' => $totalSales,
    'totalOrders' => $totalOrders,
    'totalCustomers' => $totalCustomers,
]);
