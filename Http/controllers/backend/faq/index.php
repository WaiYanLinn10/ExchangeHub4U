<?php

use Core\App;
use Core\FAQ;

$faq = App::resolve(FAQ::class);


$faqs = $faq->getAllFAQs();
// dd($faqs);

function getCustomerName($db, $customerId)
{
    if (empty($customerId)) {
        return '-';
    }
    $customer = $db->query("SELECT customer_name FROM customer WHERE customer_id = :id", ['id' => $customerId])->find();
    return htmlspecialchars($customer['customer_name']);
}


function getAdminName($db, $adminId)
{
    if (empty($adminId)) {
        return '-';
    }
    $admin = $db->query("SELECT admin_name FROM admin WHERE admin_id = :id", ['id' => $adminId])->find();
    return htmlspecialchars($admin['admin_name']);
}

function generateActionLinks($index)
{
    return '<a class="text-decoration-none text-secondary mx-2" href="#" data-bs-toggle="modal" data-bs-target="#answerModal' . $index . '">Answer</a>
            <a href="#" class="text-decoration-none text-secondary" data-bs-toggle="modal" data-bs-target="#faqDeleteModal' . $index . '"><i class="fa-solid fa-trash"></i></a>';
}


view_admin("faq/index.view.php", [
    'heading' => 'Manage FAQ',
    'faqs' => $faqs,
]);
