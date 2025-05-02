<?php require('partials/head.php') ?>
<?php require('partials/nav.php') ?>
<?php

use Core\Session;
use Core\App;
use Core\Database;
// dd($_SESSION['id']);
if (Session::has('id')) {
    // Get user_id from the session
    $userId = Session::get('id');
    $db = App::resolve(Database::class);
    $user = $db->query('SELECT user_type FROM user WHERE user_id = ?', [$userId])->find();
    // dd($user);
}
?>



<main>
    <div class="container mx-auto py-5">
        <div class="row justify-content-center">
            <div class="col-12 text-center">
                <h1 class="display-4 font-weight-bold">You are not authorized to view this page.</h1>
                <p class="mt-3">
                <?php 
                    if ($user['user_type'] == 0) {
                ?>
                        <a href="/admin" class="text-primary text-decoration-underline">Go back to Admin Panel.</a>
                <?php 
                    } else {
                ?>
                        <a href="/" class="text-primary text-decoration-underline">Go back home.</a>
                <?php
                    }
                ?>
                </p>
            </div>
        </div>
    </div>
</main>

<?php require('partials/footer.php') ?>
