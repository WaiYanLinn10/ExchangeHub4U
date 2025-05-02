<?php
use Core\App;
use Core\Database;
use Core\Session;

$db = App::resolve(Database::class);
// dd($_SESSION);
if (!Session::has('id')) {
    header('location:index.php');
    exit;
}

$user_id = Session::get('id');
// dd($user_id);
$data = $db->query("SELECT username, user_type FROM user WHERE user_id = ?", [$user_id])->find();

if ($data['user_type'] !== 0) {

    header('location:index.php');
    exit;
}

$menu_items = [
    "/admin" => ["Dashboard", "fa-tachometer-alt"],
    "/admin/order" => ["Orders", "fa-receipt"],
    "/admin/product" => ["Products", "fa-box"],
    "/admin/admin" => ["Admins", "fa-user-shield"],
    "/admin/customer" => ["Customers", "fa-user-friends"],
    "/admin/brand" => ["Brands", "fa-tags"],
    "/admin/category" => ["Categories", "fa-folder"],
    "/admin/faq" => ["Q&A", "fa-question-circle"]

];

?>

<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">
<head>
    <meta charset="UTF-8">
    <title>ExchangeHub4U</title>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.css' integrity='sha512-VcyUgkobcyhqQl74HS1TcTMnLEfdfX6BbjhH8ZBjFU9YTwHwtoRtWSGzhpDVEJqtMlvLM2z3JIixUOu63PNCYQ==' crossorigin='anonymous'/>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.css' integrity='sha512-9nqhm3FWfB00id4NJpxK/wV1g9P2QfSsEPhSSpT+6qrESP6mpYbTfpC+Jvwe2XY27K5mLwwrqYuzqMGK5yC9/Q==' crossorigin='anonymous'/>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/hover.css/2.3.1/css/hover.css'/>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .nav-link.active {
                background-color:rgb(158, 66, 133) !important; /* Change to your preferred color */
                color: white !important; /* Ensure text remains readable */
            }
        /* .nav-link:hover {
        background-color: rgb(112, 44, 100) !important; /* Suitable hover color */
        color: white !important;
    } */


    </style>
</head>

<body>


<div class="row w-100 m-0">
    <div class="offcanvas offcanvas-start show text-bg-white p-4 d-none d-md-block" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel" style="max-width: 17%;">
        <h4 class="text-center fst-italic">ExchangeHub<br>4U</h4>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
            <?php foreach ($menu_items as $url => [$label, $icon]): ?>
                <li>
                    <a href="<?= $url ?>" class="nav-link text-black <?= urlIs($url) ? 'active' : '' ?>">
                        <i class="fa-solid <?= $icon ?> align-text-bottom"></i>&nbsp; <?= $label ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    
    <div class="col-md-2" id="extraspace"></div>
    <div class="col-md-10 p-0" id="mainSection" style="background-color: #f8f9fc;">
        <!-- desktop navbar -->
        <div class="navbar navbar-expand-lg shadow-sm bg-white py-0 d-none d-sm-block">
            <div class="container-fluid">
                <div class="col-sm-2 py-2">
                    <button class="border-0 bg-white d-none d-sm-block" type="button" id="sidePanelController" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling">
                        <i class="fa-solid fa-bars fs-5"></i>
                    </button>
                </div>
                <div class="col-sm-3 py-2"></div>
                <div class="col-sm-4"></div>
                <div class="col-sm-1 py-2 px-2 h-100 text-center bg-light">
                <a href="/" class="text-decoration-none text-dark text-uppercase bg-light">
                    <i class="fa-solid fa-store fs-4"></i>Website</a>
                </div>
                <div class="col-sm-1 py-2 px-2 h-100 text-center bg-light">
                    <a href="#" class="text-decoration-none text-dark text-uppercase bg-light"><i class="fa-solid fa-circle-user fs-4 align-text-bottom"></i> <?php echo $data['username']; ?></a>
                </div>
                <div class="col-sm-1 py-2 px-2 h-150 text-center bg-light">
                    <form method="POST" action="/session">
                        <input type="hidden" name="_method" value="DELETE"/>
                        <button class="nav-link text-dark text-uppercase">
                        <i class="fa-solid fa-right-from-bracket fs-4 align-text-bottom"></i>
                        <br>
                        Log Out
                    </button>
                    </form>                
                </div>
            </div>
        </div>

        <?php if (Session::has('message')): ?>
            <?php list($type, $message) = Session::get('message'); ?>

            <div class="alert <?php echo ($type === 'success') ? 'alert-success' : 'alert-danger'; ?>" id="flashMessage">
                <?php echo $message; ?>
            </div>

            <?php Session::unflash();?>
        <?php endif; ?>

        <script>
            // Auto-hide the flash message after 3 seconds
            setTimeout(function() {
                let alert = document.getElementById('flashMessage');
                if (alert) {
                    alert.style.transition = "opacity 0.5s";
                    alert.style.opacity = "0";
                    setTimeout(() => alert.remove(), 500);
                }
            }, 3000);
        </script>

       
