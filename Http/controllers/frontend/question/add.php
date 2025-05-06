<?php
use Core\Session;
use Core\Database;
use Core\App;
// dd($_POST);
$db = App::resolve(Database::class);

if (!Session::has('id')) {
    Session::flash('message', ['fail', 'You need an account to ask a question.']);
    redirect('/');
    exit;
}
$user_id = Session::get('id');

$customer = $db->query("SELECT customer_id FROM customer WHERE user_id = ?", [$user_id])->find();
$customer_id = $customer['customer_id'];



if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['question'])) {
    $db->query("INSERT INTO faq (faq_question, customer_id, created_time) VALUES (?, ?, NOW())", 
        [trim($_POST['question']), $customer_id]
    );


    Session::flash('message', ['success', 'Your question has been submitted successfully.']);

    redirect('/faq');
    exit;
}
