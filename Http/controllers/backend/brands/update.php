<?php

use Core\App;
use Core\Database;
use Core\Session;

$db = App::resolve(Database::class);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_POST['brandName'])) {
        Session::flash('fail', 'The brand name cannot be empty.');
        redirect('/admin/brand');
        exit;
    }

    $brand_id = $_POST['id'];
    $brand_name = $_POST['brandName'];
    $upload_dir = 'images/brands/';
    $new_brand_img = $_POST['old_brand_img']; // Default to old image

    if (!empty($_FILES['brandImg']['name'])) {  
        $brand_img = $_FILES['brandImg'];
        $allowed_ext = ['jpg', 'jpeg', 'png', 'gif'];
        $max_size = 2 * 1024 * 1024; // 2MB
        $brand_img_ext = strtolower(pathinfo($brand_img['name'], PATHINFO_EXTENSION));

        // Validate file extension
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
        // $new_brand_img = uniqid('', true) . '.' . $product_img_ext;

        $new_brand_img = $brand_img['name'];
        $upload_path = $upload_dir . $new_brand_img;
        // Move uploaded file
        if (move_uploaded_file($brand_img['tmp_name'], $upload_path)) {
            // Delete old image if it exists
            if (!empty($_POST['old_brand_img']) && file_exists($upload_dir . $_POST['old_brand_img'])) {
                unlink($upload_dir . $_POST['old_brand_img']);
            }
        } else {
            Session::flash('fail', 'There was an error uploading the file.');
            redirect('/admin/brand');
            exit;
        }
    }

    // Check if brand name already exists
    $existing_brand = $db->query("SELECT * FROM brand WHERE brand_name = :brand_name AND brand_id != :brand_id", [
        'brand_name' => $brand_name,
        'brand_id' => $brand_id,
    ])->find();

    if ($existing_brand) {
        Session::flash('fail', 'Brand name already exists. Please choose a different name.');
        redirect('/admin/brand');
        exit;
    }

    // Update brand in the database
    $db->query("UPDATE brand SET brand_name = :brand_name, brand_img = :brand_img WHERE brand_id = :brand_id", [
        'brand_name' => $brand_name,
        'brand_img' => $new_brand_img,
        'brand_id' => $brand_id
    ]);

    Session::flash('success', 'Brand updated successfully.');
    redirect('/admin/brand');
    exit;
}
