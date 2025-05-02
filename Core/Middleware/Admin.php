<?php

namespace Core\Middleware;

class Admin
{
    public function handle()
    {

        if (!isset($_SESSION['user']) && $_SESSION['user']['user_type'] != 0) {
            header('Location: /'); 
        }
    }
}
