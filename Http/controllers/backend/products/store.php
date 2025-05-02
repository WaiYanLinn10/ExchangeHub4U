<?php 

use Core\Database;
use Core\Session;
use Core\App;

// dd($_POST); 
$db = App::resolve(Database::class);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_POST['productName']) || empty($_POST['category']) || empty($_POST['brand']) || 
        empty($_POST['productDescription']) || empty($_POST['productPrice']) || empty($_POST['productQuantity']) || 
        empty($_FILES['productImg']['name'])) {
        
        Session::flash('fail', 'The new product data cannot be empty.');
    redirect('/admin/product');
        exit;
    }

    $product_name = $_POST['productName'];
    $product_price = $_POST['productPrice'];
    $category = $_POST['category'];
    $brand = $_POST['brand'];
    $product_description = $_POST['productDescription'];
    $product_quantity = $_POST['productQuantity'];

    $product_img = $_FILES['productImg'];
    $allowed_ext = ['jpg', 'jpeg', 'png', 'gif'];
    $upload_dir = 'images/products/';
    $max_size = 2 * 1024 * 1024; // 2MB

    // Validate file extension
    $product_img_ext = strtolower(pathinfo($product_img['name'], PATHINFO_EXTENSION));
    if (!in_array($product_img_ext, $allowed_ext)) {
        Session::flash('fail', 'Only JPG, JPEG, PNG & GIF files are allowed.');
        redirect('/admin/product');
        exit;
    }

    // Validate file size
    if ($product_img['size'] > $max_size) {
        Session::flash('fail', 'File size exceeds the limit of 2MB.');
        redirect('/admin/product');
        exit;
    }

    // Generate unique file name and upload path
    $new_product_img = uniqid('', true) . '.' . $product_img_ext;
    $upload_path = $upload_dir . $new_product_img;

    // Attempt to move uploaded file
    if (!move_uploaded_file($product_img['tmp_name'], $upload_path)) {
        Session::flash('fail', 'There was an error uploading the file.');
        redirect('/admin/product');
        exit;
    }

    // Insert product data into the database
    $db->query("INSERT INTO product (product_name, product_img, product_price, product_description, product_quantity, category_id, brand_id) VALUES (:product_name, :product_img, :product_price, :product_description, :product_quantity, :category_id, :brand_id)", [
        'product_name' => $product_name,
        'product_img' => $new_product_img,
        'product_price' => $product_price,
        'product_description' => $product_description,
        'product_quantity' => $product_quantity,
        'category_id' => $category,
        'brand_id' => $brand
    ]);

    Session::flash('success', 'Product added successfully.');
    redirect('/admin/product');
    exit;
} else {
    Session::flash('fail', 'Invalid request method.');
    redirect('/admin/product');
    exit;
}   


