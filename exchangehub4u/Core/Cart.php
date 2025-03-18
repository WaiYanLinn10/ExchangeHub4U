<?php

namespace Core;

class Cart {

    public function getCartItems($customerId)
    {
        $db = App::resolve(Database::class);

        return $db->query('SELECT * FROM shoppingcart AS sc
                JOIN shoppingcart_product AS scp ON sc.shoppingcart_id = scp.shoppingcart_id
                JOIN products AS p ON scp.product_id = p.product_id
                JOIN brand AS b ON p.brand_id = b.brand_id
                JOIN category AS c ON p.category_id = c.category_id
                WHERE sc.customer_id = :customer_id
                ORDER BY scp.shoppingcart_product_id DESC', [
            'customer_id' => $customerId
        ])->get();
    }

    public function getCartCount($customerId)
    {
        $db = App::resolve(Database::class);

        $sql = "SELECT COUNT(*) AS count FROM shoppingcart AS sc
                JOIN shoppingcart_product AS scp ON sc.shoppingcart_id = scp.shoppingcart_id
                WHERE sc.customer_id = :customer_id";

        $result = $db->query($sql, [
            'customer_id' => $customerId
        ])->find();

        return $result['count'];
    }

    public function calculateTotal($cartItems)
    {
        $total = 0;
        foreach ($cartItems as $item) {
            if (isset($item['quantity']) && isset($item['product_price'])) {
                $total += $item['quantity'] * $item['product_price'];
            }
        }

        return $total;
    }
}