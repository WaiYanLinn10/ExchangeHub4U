<?php
use Core\Session;
use Core\Database;
use Core\App;

$db = App::resolve(Database::class);

if (!Session::has('id')) {
    Session::flash('message', ['fail', 'You need an account to buy a product.']);
    redirect('/shop');
    exit;
}

$cartItems = [];
$total = 0;
$deliveryFee = 2000;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['cart_items'], $_POST['cart_quantities'])) {
        $cart_items = $_POST['cart_items']; // array of product IDs
        $cart_quantities = $_POST['cart_quantities']; // array of quantities

        foreach ($cart_items as $index => $product_id) {
            $quantity = intval($cart_quantities[$index]);
            $product = $db->query("SELECT * FROM product WHERE product_id = ?", [$product_id])->find();

            if ($product && $product['product_quantity'] > 0) {
                $cartItems[] = [
                    'product_name' => $product['product_name'],
                    'product_price' => $product['product_price'],
                    'quantity' => $quantity,
                    'total_price' => $product['product_price'] * $quantity
                ];
                $total += $product['product_price'] * $quantity;
            }
        }

        $total += $deliveryFee;

        view("checkout.view.php", [
            'heading' => 'Checkout',
            'cartItems' => $cartItems,
            'total' => $total,
            'deliveryFee' => $deliveryFee
        ]);
    } else {
        Session::flash('message', ['fail', 'No items in the cart to checkout.']);
        redirect('/shop');
        exit;
    }
}
