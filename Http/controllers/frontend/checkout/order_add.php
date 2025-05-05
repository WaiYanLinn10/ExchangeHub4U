<?php
use Core\App;
use Core\Session;
use Core\Database;

$db = App::resolve(Database::class);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!Session::has('id')) {
        Session::flash('message', ['fail', 'You need an account to place an order.']);
        redirect('/shop');
    }

    $user_id = Session::get('id');
    $customer = $db->query("SELECT * FROM customer WHERE user_id = ?", [$user_id])->find();

    $total = $_POST['total_price'];
    $delivery_name = $_POST['firstname'] . ' ' . $_POST['lastname'];
    $full_address = $_POST['city'] . ' ' . $_POST['address'];
    $transaction_no = $_POST['transaction_no'] ?? null;
    $paymentType = ($_POST['paymentType'] === 'bankTransfer') ? 1 : 2;
    $phone = $_POST['phone'];

    $db->query("INSERT INTO `order` (shipping_address, delivery_name, phone_no, customer_id) VALUES (?, ?, ?, ?)", 
        [$full_address, $delivery_name, $phone, $customer['customer_id']]);
    $order_id = $db->lastInsertId();

    // Only one of these blocks will execute
    if (isset($_POST['cart_id'])) {
        // CART CHECKOUT
        $cart_id = $_POST['cart_id'];
        $cartItems = $db->query("SELECT product_id, quantity FROM shoppingcart_product WHERE shoppingcart_id = ?", [$cart_id])->get();

        foreach ($cartItems as $item) {
            $db->query("INSERT INTO order_product (order_id, product_id, order_product_quantity) VALUES (?, ?, ?)", 
                [$order_id, $item['product_id'], $item['quantity']]);
            $db->query("UPDATE product SET product_quantity = product_quantity - ? WHERE product_id = ?", 
                [$item['quantity'], $item['product_id']]);
        }

        $db->query("DELETE FROM shoppingcart_product WHERE shoppingcart_id = ?", [$cart_id]);

    } elseif (isset($_POST['product_id'], $_POST['quantity'])) {
        // BUY NOW
        $product_id = $_POST['product_id'];
        $quantity = $_POST['quantity'];

        $db->query("INSERT INTO order_product (order_id, product_id, order_product_quantity) VALUES (?, ?, ?)", 
            [$order_id, $product_id, $quantity]);
        $db->query("UPDATE product SET product_quantity = product_quantity - ? WHERE product_id = ?", 
            [$quantity, $product_id]);
    }

    // Insert payment
    $db->query("INSERT INTO payment (total_amount, transaction_no, customer_id, order_id, payment_type_id) VALUES (?, ?, ?, ?, ?)", 
        [$total, $transaction_no, $customer['customer_id'], $order_id, $paymentType]);

    Session::flash('message', ['success', 'Your order has been placed successfully.']);
    redirect('/');
}
    
    else {
        Session::flash('message', ['fail', 'Invalid request.']);
        redirect('/shop');
    }
