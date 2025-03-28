<?php

use Core\App;
use Core\Database;
use Core\ShopManager;


$db = App::resolve(Database::class);

$shopManager = new ShopManager($db);

$categories = $shopManager->getCategories();
$categoryAllCount = $shopManager->getAllCategoryProducts();

$filters = [];
$params = [];

if (isset($_GET['category'])) {
    $filters['category'] = $_GET['category'];
}

if (isset($_GET['start']) && isset($_GET['end'])) {
    $filters['start'] = $_GET['start'];
    $filters['end'] = $_GET['end'];
}

if (isset($_GET['search'])) {
    $filters['search'] = $_GET['search'];
}


$queryData = $shopManager->getProducts($filters);
$productsQuery = $queryData['query'];
$params = $queryData['params'];

// Pagination logic
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$prodsPerPage = 6;

$paginatedResult = $shopManager->getPaginatedProducts($productsQuery, $params, $page, $prodsPerPage);
$products = $paginatedResult['products'];
$numberOfPage = $paginatedResult['totalPages'];

view("shop.view.php", [
    'heading' => 'Shop',
    'categories' => $categories,
    'categoryAllCount' => $categoryAllCount,
    'products' => $products,
    'numberOfPage' => $numberOfPage,
    'currentPage' => $page,
    'filters' => $filters,
    'db' => $db
]);