<?php
use Core\App;
use Core\Database;
use Core\Session;
use Core\Wishlist;
use Core\Cart;


// Resolve dependencies
$db = App::resolve(Database::class);
$cart = App::resolve(Cart::class);
$wishlist = App::resolve(Wishlist::class);

// Check if user is logged in
if (Session::has('id')) {
    $userId = Session::get('id');

    $user = $db->query("SELECT * FROM user WHERE user_id = ?", [$userId])->find();
    $userType = $user['user_type'] ?? 1;

    $customer = $db->query("SELECT customer_id FROM customer WHERE user_id = ?", [$userId])->find();
    $customerId = $customer['customer_id'] ?? null; 
    
    $cartCount = $customerId ? $cart->getCartCount($customerId) : 0;
    $wishlistCount = $customerId ? $wishlist->getWishlistCount($customerId) : 0;
} else {
    // Default values for guests
    $customerId = null;
    $cartCount = 0;
    $wishlistCount = 0;
}

?>


<div class="col-md-12 d-lg-block d-xl-block d-none shadow-sm bg-light">
    <div class="container pr-4">
        <div class="row py-2">

            <div class="col-md-2 d-flex align-items-center justify-content-center pr-0">
                <h4 class="my-0 fst-italic">ExchangeHub4U</h4>
            </div>

            <div class="col-md-5 pr-0">
                <nav class="nav mt-2">
                    <a href="/"
                    class="<?= urlIs('/') ? 'border-bottom border-3 pb-1' : 'text-gray-300'; ?> nav-link text-dark text-uppercase">Home</a>
                    <a href="/about"
                    class="<?= urlIs('/about') ? 'border-bottom border-3 pb-1' : 'text-gray-300' ?> nav-link text-dark text-uppercase">About</a>
                    <a href="/contact"
                    class="<?= urlIs('/contact') ? 'border-bottom border-3 pb-1' : 'text-gray-300' ?> nav-link text-dark text-uppercase">Contact</a>
                    <a href="/shop"
                    class="<?= urlIs('/shop') ? 'border-bottom border-3 pb-1' : 'text-gray-300' ?> nav-link text-dark text-uppercase">Shop</a>

                </nav>
            </div>
    
            <div class="col-md-5 px-0">
                <nav class="nav mt-2 float-end">
                    
                    <a class="nav-link text-dark text-uppercase iconClass" aria-current="page" href="/wishlist">
                        <i class="fa-solid fa-heart fs-4" id="wishlist-icon"></i>
                        <span class="badge bg-danger rounded-pill">
                        <?php
                        if(!empty($_SESSION['id'])){ echo $wishlistCount; } else {
                            echo "0";
                        }
                        ?>
                        </span>
                    </a>

                    <a class="nav-link text-dark text-uppercase iconClass" href="/cart">
                        <i class="fa-solid fa-cart-shopping fs-4" id="cart-icon"></i>
                        <span class="badge bg-danger rounded-pill">
                        <?php
                        if(!empty($_SESSION['id'])){ echo $cartCount; } else {
                            echo "0";
                        }
                        ?>
                        </span>
                    </a>


                    <?php if ($_SESSION['user'] ?? false) : ?>
                        <a href="/account/index" class="nav-link text-dark">
                            <i class="fa-solid fa-circle-user fs-4 align-text-bottom"></i>
                            
                            <?= htmlspecialchars($_SESSION['user']['username'] ?? 'Guest') ?>
                        </a>
                    <?php if ($user['user_type'] === 0) : ?>
                        <a href="/admin" class="nav-link text-dark">
                        <i class="fa-solid fa-user-shield"></i> Admin Panel </a>
                    <?php else : ?>
                        <form method="POST" action="/session">
                            <input type="hidden" name="_method" value="DELETE"/>
                            <button class="nav-link text-dark text-uppercase">
                                <i class="fa-solid fa-right-from-bracket fs-4 align-text-bottom"></i>
                            </button>
                        </form>
                    <?php endif; ?>
                    <?php else : ?>
                        <a href="/register"
                            class="<?= urlIs('/register') ?> nav-link text-dark text-uppercase">Register</a>
                        <a href="/login"
                            class="<?= urlIs('/login') ?> nav-link text-dark text-uppercase">Log In</a>
                    <?php endif ?>
                </nav>
            </div>
            
        </div>
        
    </div>
</div>

<!-- Mobile Navigation -->
    <nav class="navbar navbar-expand-lg bg-light d-lg-none d-xl-none shadow-sm sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">ExchangeHub4U</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#staticBackdrop" aria-controls="staticBackdrop">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>

    <!-- offcanvas menu for mobile version -->
    <div class="offcanvas-lg offcanvas-end d-lg-none d-xl-none" data-bs-backdrop="static" tabindex="-1" id="staticBackdrop" aria-labelledby="staticBackdropLabel">
        <div class="offcanvas-header bg-dark">
            <h5 class="offcanvas-title text-light">MENU</h5>
            <button type="button" class="btn-close bg-light rounded-pill" data-bs-dismiss="offcanvas" data-bs-target="#staticBackdrop" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <nav class="nav flex-column">
                <a class="nav-link text-dark text-uppercase" href="/">Home</a>
                <a class="nav-link text-dark text-uppercase" href="/shop">Shop</a>
                <a class="nav-link text-dark text-uppercase" href="/about">About</a>
                <a class="nav-link text-dark text-uppercase" href="/blog">Blog</a>
                <a class="nav-link text-dark text-uppercase iconClass" href="/wishlist">WISHLIST</a>
                <a class="nav-link text-dark text-uppercase iconClass" href="/cart">CART</a>
                <?php
                    if(!empty($_SESSION['id'])){
                ?>
                    <a class="nav-link text-dark text-uppercase" href="/account/index">ACCOUNT</a>
                    <form method="POST" action="/session">
                        <input type="hidden" name="_method" value="DELETE"/>
                        <button class="nav-link text-dark text-uppercase">
                            LOGOUT
                        </button>
                    </form>
                <?php
                    }else{
                ?>
                    <a class="nav-link text-dark text-uppercase" href="/register">REGISTER</a>
                    <a class="nav-link text-dark text-uppercase" href="/login">LOGIN</a>
                <?php
                    }
                ?>
            </nav>
        </div>
    </div>
</div>



