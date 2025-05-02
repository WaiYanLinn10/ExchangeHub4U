<?php

use Core\App;
use Core\Database;
use Core\Session;

$db = App::resolve(Database::class);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_POST['brandName'])) {
        Session::flash('fail', 'The new brand data cannot be empty.');
        redirect('/admin/brand');
        exit;
    }

    $brand_name = $_POST['brandName'];
    $brand_img = $_FILES['brandImg'];
    $allowed_ext = ['jpg', 'jpeg', 'png', 'gif'];
    $upload_dir = 'images/brands/';
    $max_size = 2 * 1024 * 1024; // 2MB

    // Validate file extension
    $brand_img_ext = strtolower(pathinfo($brand_img['name'], PATHINFO_EXTENSION));
    if (!in_array($brand_img_ext, $allowed_ext)) {
        Session::flash('fail', 'Only JPG, JPEG, PNG & GIF files are allowed.');
        redirect('/admin/brand');
        exit;
    }

    // Validate file size
    if ($brand_img['size'] > $max_size) {
        Session::flash('fail', 'File size exceeds the limit of 2MB.');
        redirect('/admin/brand');
        exit;
    }

    // Use the uploaded file name and upload path
    $new_brand_img = $brand_img['name'];
    $upload_path = $upload_dir . $new_brand_img;

    
    // Attempt to move uploaded file
    if (!move_uploaded_file($brand_img['tmp_name'], $upload_path)) {
        Session::flash('fail', 'There was an error uploading the file.');
        redirect('/admin/brand');
        exit;
    }
    

    // Check if brand name already exists
    $existing_brand = $db->query("SELECT * FROM brand WHERE brand_name = :brand_name", [
        'brand_name' => $brand_name,
    ])->find();

    if ($existing_brand) {
        Session::flash('fail', 'Brand name already exists. Please choose a different name.');
        redirect('/admin/brand');
        exit;
    }


    // Insert brand data into the database
    $db->query("INSERT INTO brand (brand_name, brand_img) VALUES (:brand_name, :brand_img)", [
        'brand_name' => $brand_name,
        'brand_img' => $new_brand_img,
    ]);

    Session::flash('success', 'New brand added successfully!');
    redirect('/admin/brand');
} else {
    redirect('/admin/brand');
}