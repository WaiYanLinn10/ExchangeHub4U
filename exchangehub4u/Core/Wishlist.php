<?php

namespace Core;

class Wishlist{

    public function getWishlistItems($customerId) 
    {
        $db = App::resolve(Database::class);
        
        return $db->query('SELECT * FROM wishlist AS w
                INNER JOIN wishlist_product AS wp ON w.wishlist_id = wp.wishlist_id
                INNER JOIN products AS p ON wp.product_id = p.product_id
                WHERE w.customer_id = ?
                ORDER BY wp.wishlist_product_id DESC', [$customerId])->get();
    }

    public function getWishlistCount($customerId) 
    {
        $result = $this->getWishlistItems($customerId);
        
        return count($result);
    }

}

