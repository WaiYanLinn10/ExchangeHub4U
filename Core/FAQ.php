<?php

namespace Core;
use Core\Database;


class FAQ{
    protected $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function getAllFAQs(): array
    {
        return $this->db->query("SELECT * FROM faq ORDER BY faq_id DESC")->get();
    }

    public function getFAQById(int $faqId): array
    {
        return $this->db->query("SELECT * FROM faq WHERE faq_id = :id", ['id' => $faqId])->find();
    }

    public function getPostedFAQs(): array
    {
        return $this->db->query("SELECT * FROM faq WHERE posted = 1 ")->get();
    }
    

}