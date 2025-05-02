<?php

namespace Core;

class ShopManager {

    private $db;

    // Inject the Database instance via the constructor
    public function __construct(Database $db) {
        $this->db = $db;
    }

    public function getCategories() {
        return $this->db->query("SELECT * FROM category")->get();
    }

    public function getAllCategoryProducts() {
        $result = $this->db->query("SELECT * FROM category as c JOIN product as p ON c.category_id = p.category_id")->get();
        return count($result);
    }

    public function getProducts($filters = []) {
        $query = "SELECT * FROM product";
        $where = [];
        $params = [];

        // Handle category filter
        if (isset($filters['category'])) {
            $where[] = "category_id = :category";
            $params['category'] = $filters['category'];
        }

        // Handle price range filter
        if (isset($filters['start']) && isset($filters['end'])) {
            $where[] = "product_price BETWEEN :start AND :end";
            $params['start'] = $filters['start'];
            $params['end'] = $filters['end'];
        }

        // Handle search filter
        if (isset($filters['search'])) {
            $where[] = "(product_name LIKE :search OR product_description LIKE :search)";
            $params['search'] = '%' . $filters['search'] . '%';
        }

        // Build the WHERE clause
        if (!empty($where)) {
            $query .= " WHERE " . implode(" AND ", $where);
        }

        // Add ordering
        $query .= " ORDER BY product_id DESC";
        return ['query' => $query, 'params' => $params];
    }

    public function getPaginatedProducts($query, $params, $page, $prodsPerPage) {
        // Count total products
        $countQuery = "SELECT COUNT(*) AS total FROM ($query) AS subquery";
        $totalProductCount = $this->db->query($countQuery, $params)->find()['total'];
    
        // Calculate total pages
        $numberOfPage = ceil($totalProductCount / $prodsPerPage);
    
        // Add LIMIT and OFFSET to the query (interpolate as integers)
        $pageFirstResult = ($page - 1) * $prodsPerPage;
        $query .= " LIMIT $prodsPerPage OFFSET $pageFirstResult";
    
        // Fetch paginated products
        $products = $this->db->query($query, $params)->get();
    
        return [
            'products' => $products,
            'totalPages' => $numberOfPage
        ];
    }
}
