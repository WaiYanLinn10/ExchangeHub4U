<?php

use Core\App;
use Core\FAQ;


$faq = App::resolve(FAQ::class);

$faqs = $faq->getPostedFAQs();
// dd($faqs);

view("faq.view.php", [
    'heading' => 'FAQs',
    'faqs' => $faqs
]);