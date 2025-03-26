<?php

use Core\Session;
use Core\Database;
use Core\App;
// dd($_SESSION);
if (!Session::has('id') || !Session::get('profile') === 'false') { 
    redirect('/account/create');
}else{

    $db = App::resolve(Database::class);
    $userId = (int) Session::get('id');
    $result = $db->query(
    'SELECT * FROM customer as c, user as u WHERE c.user_id = u.user_id AND u.user_id = ?', [$userId])->find();





        view("account/index.view.php", [
        'heading' => 'My Account',
        'user' => $result
    ]);
}