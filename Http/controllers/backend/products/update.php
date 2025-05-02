<?php

use Core\Database;
use Core\Session;
use Core\App;

$db = App::resolve(Database::class);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_POST['productName']) || empty($_POST['category']) || empty($_POST['brand']) || 
        empty($_POST['productDescription']) || empty($_POST['productPrice']) || empty($_POST['productQuantity'])) {
        
        Session::flash('fail', 'The product data cannot be empty.');
        redirect('/admin/product');
        exit;
    }

    $product_id = $_POST['id'];
    $product_name = $_POST['productName'];
    $product_price = $_POST['productPrice'];
    $category = $_POST['category'];
    $brand = $_POST['brand'];
    $product_description = $_POST['productDescription'];
    $product_quantity = $_POST['productQuantity'];

    $upload_dir = 'images/products/';
    $new_product_img = $_POST['old_product_img']; // Default to old image

    if (!empty($_FILES['productImg']['name'])) { 
        $product_img = $_FILES['productImg'];
        $allowed_ext = ['jpg', 'jpeg', 'png', 'gif'];
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

        // Generate unique filename
        $new_product_img = uniqid('', true) . '.' . $product_img_ext;
        $upload_path = $upload_dir . $new_product_img;

        // Attempt to move uploaded file
        if (move_uploaded_file($product_img['tmp_name'], $upload_path)) {
            // Delete old image if it exists
            if (file_exists($upload_dir . $_POST['old_product_img'])) {
                unlink($upload_dir . $_POST['old_product_img']);
            }
        } else {
            Session::flash('fail', 'There was an error uploading the file.');
            redirect('/admin/product');
            exit;
        }
    }

    // Update product in the database
    $db->query("UPDATE product SET product_name = :product_name, product_price = :product_price, category_id = :category_id, 
                brand_id = :brand_id, product_description = :product_description, product_quantity = :product_quantity, 
                product_img = :product_img WHERE product_id = :product_id", [
        'product_name' => $product_name,
        'product_price' => $product_price,
        'category_id' => $category,
        'brand_id' => $brand,
        'product_description' => $product_description,
        'product_quantity' => $product_quantity,
        'product_img' => $new_product_img,
        'product_id' => $product_id
    ]);

    Session::flash('success', 'Product updated successfully.');
    redirect('/admin/product'); 
    exit;
} else {
    Session::flash('fail', 'Invalid request method.');
    redirect('/admin/product'); 
    exit;
}
