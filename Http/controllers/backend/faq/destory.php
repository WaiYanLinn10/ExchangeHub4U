<?php

use Core\App;
use Core\Database;
use Core\Session;

$db = App::resolve(Database::class);

$faq_id = (int) $_POST['faq_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['faq_id'])) {
    
    $db->query("DELETE FROM faq WHERE faq_id = ?", [$faq_id]);
    Session::flash('success', 'FAQ deleted successfully.');
    redirect('/admin/faq');
} else {
    // dd("fail");
    Session::flash('fail', 'Invalid request.');
    redirect('/admin/faq');
}