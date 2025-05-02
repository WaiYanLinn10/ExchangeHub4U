<?php

use Core\App;
use Core\Database;
use Core\Session;


// dd($_POST);

$db = App::resolve(Database::class);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_POST['question']) || empty($_POST['answer']) || empty($_POST['status'])){
        Session::flash('fail', 'The new FAQ data cannot be empty.');
        redirect('/admin/faq');
        exit;
    }

    $faq_question = $_POST['question'];
    $faq_answer = $_POST['answer'];
    $status = $_POST['status'];

    $existing_faq = $db->query("SELECT * FROM faq WHERE faq_question = :faq_question", [
        'faq_question' => $faq_question,
    ])->find(); 

    if ($existing_faq) {
        Session::flash('fail', 'FAQ already exists. Please ask another question.');
        redirect('/admin/faq');
        exit;
    }

    $admin_id = $_SESSION['id'];

    // dd($admin_id);
    if (!$admin_id) {
        Session::flash('fail', 'Admin ID is missing. Please log in again.');
        redirect('/admin/login');
        exit;
    }
    $db->query("INSERT INTO faq (faq_question, faq_answer, posted, admin_id, answer_time) VALUES (:faq_question, :faq_answer, :posted, :admin_id, NOW())", [
        'faq_question' => $faq_question,
        'faq_answer' => $faq_answer,
        'posted' => $status,
        'admin_id' => $admin_id,
    ]);

    Session::flash('success', 'New FAQ has been added successfully.');
    redirect('/admin/faq');
    exit;
} else {
    Session::flash('fail', 'Invalid request method.');
    redirect('/admin/faq');
    exit;
}