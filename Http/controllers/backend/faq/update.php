<?php

use Core\App;
use Core\Database;  
use Core\Session;


$admin_id = Session::get('id');
$db = App::resolve(Database::class);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $faq_id = $_POST['id']; 
    $faq_answer = $_POST['answer'];

    $db->query("UPDATE faq SET faq_answer = :answer, answer_time = NOW(), admin_id = :admin_id WHERE faq_id = :id", [
        'answer' => $faq_answer,
        'admin_id' => $admin_id,
        'id' => $faq_id,
    ]);

    Session::flash('success', 'FAQ updated successfully.');
} else {
    Session::flash('fail', 'Invalid request.');
}

redirect('/admin/faq');

