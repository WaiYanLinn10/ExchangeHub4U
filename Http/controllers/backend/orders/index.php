<?php
use Core\Database;
use Core\App;

$db = App::resolve(Database::class);

$result = $db->query(
    'SELECT o.*, c.customer_name, p.total_amount
    FROM `order` AS o
    JOIN customer AS c ON c.customer_id = o.customer_id
    JOIN payment AS p ON o.order_id = p.order_id
    ORDER BY o.order_date ASC;'
    )->get();

view_admin("orders/index.view.php", [
    'heading' => 'Manage Orders',
    'orders' => $result,

]);
