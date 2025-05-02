<?php

use Core\Database;
use Core\App;

$db = App::resolve(Database::class);
// dd($_GET);
if (isset($_GET['id'])) {

    $orderId = $_GET['id'];

    $orderDetails = $db->query(
    'SELECT * FROM order_product AS op 
    JOIN `order` AS o ON o.order_id = op.order_id
    JOIN product AS p ON op.product_id = p.product_id
    JOIN customer AS c ON o.customer_id = c.customer_id
    JOIN payment AS py ON o.order_id = py.order_id
    JOIN payment_type AS pyt ON py.payment_type_id = pyt.payment_type_id
    WHERE o.order_id = :order_id', ['order_id' => $orderId])->find();

    // dd($orderDetails);

    $productDetails = $db->query(
        'SELECT * FROM order_product AS op
        JOIN product AS p ON op.product_id = p.product_id
        WHERE op.order_id = :order_id', ['order_id' => $orderId])->get();
    // dd($productDetails);

}
view_admin("orders/show.view.php", [
    'heading' => 'Product Details',
    'orderDetails' => $orderDetails,
    'productDetails' => $productDetails,

]);
