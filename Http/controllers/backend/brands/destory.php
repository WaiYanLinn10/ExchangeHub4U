<?php

use Core\App;
use Core\Database;
use Core\Session;

$db = App::resolve(Database::class);

$brand_id = (int) $_POST['brand_id'];


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['brand_id'])) {
    // dd("success");
    $db->query("DELETE FROM brand WHERE brand_id = ?", [$brand_id]);
    Session::flash('success', 'Brand deleted successfully.');
    redirect('/admin/brand');
} else {
    // dd("fail");
    Session::flash('fail', 'Invalid request.');
    redirect('/admin/brand');
}   