<?php

namespace Core;

class Wishlist
{
    protected $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function getWishlistItems($customerId)
    {
        return $this->db->query(
            'SELECT * FROM wishlist AS w
            INNER JOIN wishlist_product AS wp ON w.wishlist_id = wp.wishlist_id
            INNER JOIN product AS p ON wp.product_id = p.product_id
            WHERE w.customer_id = ?
            ORDER BY wp.wishlist_product_id DESC',
            [$customerId]
        )->get() ?? [];
    }

    public function getWishlistCount($customerId)
    {
        return count($this->getWishlistItems($customerId));
    }
}
