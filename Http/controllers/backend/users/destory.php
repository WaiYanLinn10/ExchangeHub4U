<?php

use Core\App;
use Core\Database;
use Core\Session;


$db = App::resolve(Database::class);

$user_id = (int) $_POST['user_id'];

$db->query("DELETE FROM user WHERE user_id = ?", [$user_id]);


Session::flash('success', 'User deleted successfully.');
redirect('/admin/user');

