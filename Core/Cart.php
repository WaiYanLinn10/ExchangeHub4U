<?php

namespace Core;
use Core\Database;

class Cart
{
    protected $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    /**
     * Get all cart items for a customer.
     */
    public function getCartItems(int $customerId): array
    {
        return $this->db->query(
            'SELECT scp.shoppingcart_product_id, p.product_id, p.product_name, p.product_img, 
                    p.product_price, scp.quantity, b.brand_name, c.category_name, sc.shoppingcart_id
             FROM shoppingcart AS sc
             JOIN shoppingcart_product AS scp ON sc.shoppingcart_id = scp.shoppingcart_id
             JOIN product AS p ON scp.product_id = p.product_id
             JOIN brand AS b ON p.brand_id = b.brand_id
             JOIN category AS c ON p.category_id = c.category_id
             WHERE sc.customer_id = ?
             ORDER BY scp.shoppingcart_product_id DESC',
            [$customerId]
        )->get();
    }

    /**
     * Get the number of items in a customer's cart.
     */
    public function getCartCount(int $customerId): int
    {
        $result = $this->db->query(
            "SELECT COUNT(*) AS count 
             FROM shoppingcart AS sc
             JOIN shoppingcart_product AS scp ON sc.shoppingcart_id = scp.shoppingcart_id
             WHERE sc.customer_id = ?",
            [$customerId]
        )->find();

        return (int) ($result['count'] ?? 0);
    }

    /**
     * Calculate the total price of the cart.
     */
    public function calculateTotal(array $cartItems): float
    {
        return array_reduce($cartItems, function ($total, $item) {
            return $total + ($item['quantity'] * $item['product_price']);
        }, 0);
    }

    /**
     * Get a cart by customer ID.
     */
    public function getCartByCustomerId(int $customerId): ?array
{
    $result = $this->db->query(
        "SELECT * FROM shoppingcart WHERE customer_id = ?",
        [$customerId]
    )->find();

    // Return null if no cart is found, otherwise return the cart data
    return $result ?: null;
}


    /**
     * Create a new cart for a customer.
     */
    public function createCart(int $customerId): ?array
    {
        $this->db->query(
            "INSERT INTO shoppingcart (customer_id) VALUES (?)",
            [$customerId]
        );

        return $this->getCartByCustomerId($customerId);
    }

    /**
     * Get a specific product in the cart.
     */
    public function getCartProduct(int $cartId, int $productId): ?array
    {
    $result = $this->db->query(
        "SELECT * FROM shoppingcart_product WHERE shoppingcart_id = ? AND product_id = ?",
        [$cartId, $productId]
    )->find();

    return $result !== false ? $result : null;
    }

    /**
     * Add a product to the cart or update the quantity if it already exists.
     */
    public function addProductToCart(int $cartId, int $productId, int $quantity): bool
    {
        $existingProduct = $this->getCartProduct($cartId, $productId);
    
        if ($existingProduct) {
            // Update existing product quantity
            $result = $this->db->query(
                "UPDATE shoppingcart_product SET quantity = quantity + ? WHERE shoppingcart_id = ? AND product_id = ?",
                [$quantity, $cartId, $productId]
            );
        } else {
            // Insert new product into cart
            $result = $this->db->query(
                "INSERT INTO shoppingcart_product (quantity, shoppingcart_id, product_id) VALUES (?, ?, ?)",
                [$quantity, $cartId, $productId]
            );
        }
    
        // Ensure the query executed successfully
        return $result !== false;
    }
    
    /**
     * Remove a product from the wishlist.
     */
    public function removeWishlistItem(int $wishlistId): bool
    {
        $result = $this->db->query(
            "DELETE FROM wishlist_product WHERE wishlist_product_id = ?",
            [$wishlistId]
        );
    
        return $result !== false;
    }
    
    /**
     * Remove an item from the cart.
     */
    public function removeFromCart(int $cartProductId): bool
    {
        $result = $this->db->query(
            "DELETE FROM shoppingcart_product WHERE shoppingcart_product_id = ?",
            [$cartProductId]
        );
    
        return $result !== false;
    }
    
}