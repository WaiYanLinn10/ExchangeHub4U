<?php

use Core\App;
use Core\Database;
use Core\Session;

// dd($_GET);
$db = App::resolve(Database::class);


$faqId = $_GET['id'] ?? null;
$current = $_GET['current'] ?? null;

if ($faqId) {
    $db->query("UPDATE faq SET posted = :posted WHERE faq_id = :id", [
        'posted' => $current === '1' ? 0 : 1,
        'id' => $faqId
    ]);
    Session::flash('success', 'FAQ status updated successfully.');
} else {
    Session::flash('fail', 'Failed to update FAQ status.');
}

redirect('/admin/faq');