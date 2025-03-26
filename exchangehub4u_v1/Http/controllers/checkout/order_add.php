<?php

namespace App\Controllers;

use Core\Database;
use Core\Session;

class CheckoutController
{
    protected $db;
    protected $session;

    public function __construct(Database $db, Session $session)
    {
        $this->db = $db;
        $this->session = $session;
    }

    public function checkout()
    {
        // Ensure user is logged in
        if (!$this->session->has('id')) {
            redirect('/login'); // Using the redirect helper
            exit();
        }

        // Get user and order data
        $userId = $this->session->get('id');
        $user = $this->getUserData($userId);
        $totalPrice = $_POST['total_price'];
        $address = $_POST['address'];

        // Ensure payment type is provided and valid
        $paymentType = $this->getPaymentType($_POST['paymentType']);
        if ($paymentType === null) {
            // Handle invalid payment type (if needed)
            $_SESSION['error'] = 'Invalid payment type selected.';
            redirect('/checkout');
            exit();
        }

        // Process order based on product or cart
        if (isset($_POST['pid'], $_POST['quantity'])) {
            $this->processProductOrder($user, $totalPrice, $address, $paymentType, $_POST['pid'], $_POST['quantity']);
        }

        if (isset($_POST['cid'])) {
            $this->processCartOrder($user, $totalPrice, $address, $paymentType, $_POST['cid']);
        }

        // Redirect to homepage or order confirmation page
        redirect('/order/confirmation'); // Using the redirect helper
        exit();
    }

    protected function getUserData($userId)
    {
        return $this->db->query("SELECT * FROM customer WHERE user_id = ?", [$userId])->find();
    }

    protected function getPaymentType($type)
    {
        // Ensure the payment type is valid
        if ($type == 'bankTransfer') {
            return 1; // Bank Transfer
        } elseif ($type == 'cashOnDeli') {
            return 2; // Cash on Delivery
        }
        return null;
    }

    protected function processProductOrder($user, $totalPrice, $address, $paymentType, $productId, $quantity)
    {
        // Insert order into orders table
        $orderSql = "INSERT INTO orders(shipping_address, customer_id) VALUES (?, ?)";
        $this->db->query($orderSql, [$address, $user['customer_id']]);

        $orderId = $this->db->lastInsertId();
        
        // Insert product into order_product table
        $this->db->query("INSERT INTO order_product(order_id, product_id, order_product_quantity) VALUES (?, ?, ?)", [$orderId, $productId, $quantity]);

        // Update product quantity
        $this->db->query("UPDATE products SET product_quantity = product_quantity - ? WHERE product_id = ?", [$quantity, $productId]);

        // Insert payment record
        $this->db->query("INSERT INTO payment(payment_total, customer_id, order_id, payment_type_id) VALUES (?, ?, ?, ?)", [$totalPrice, $user['customer_id'], $orderId, $paymentType]);

        // Flash success message
        $this->session->flash('success', "You have successfully ordered the product.");
    }

    protected function processCartOrder($user, $totalPrice, $address, $paymentType, $cartId)
    {
        // Insert order into orders table
        $orderSql = "INSERT INTO orders(shipping_address, customer_id) VALUES (?, ?)";
        $this->db->query($orderSql, [$address, $user['customer_id']]);

        $orderId = $this->db->lastInsertId();

        // Get products in the cart
        $cartSql = "SELECT * FROM shoppingcart_product WHERE shoppingcart_id = ?";
        $cartItems = $this->db->query($cartSql, [$cartId])->get();

        foreach ($cartItems as $item) {
            $this->db->query("INSERT INTO order_product(order_id, product_id, order_product_quantity) VALUES (?, ?, ?)", [$orderId, $item['product_id'], $item['quantity']]);

            // Update product quantity
            $this->db->query("UPDATE products SET product_quantity = product_quantity - ? WHERE product_id = ?", [$item['quantity'], $item['product_id']]);
        }

        // Insert payment record
        $this->db->query("INSERT INTO payment(payment_total, customer_id, order_id, payment_type_id) VALUES (?, ?, ?, ?)", [$totalPrice, $user['customer_id'], $orderId, $paymentType]);

        // Flash success message
        $this->session->flash('success', "You have successfully ordered the product.");

        // Clear cart
        $this->db->query("DELETE FROM shoppingcart_product WHERE shoppingcart_id = ?", [$cartId]);
    }
}
