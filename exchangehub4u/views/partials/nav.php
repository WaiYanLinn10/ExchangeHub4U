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
                    <a class="nav-link text-dark text-uppercase iconClass" aria-current="page" href="/wishlist"><i class="fa-solid fa-heart fs-4" id="wishlist-icon"></i><span class="badge bg-danger rounded-pill">
                    </span></a>
                    <a class="nav-link text-dark text-uppercase iconClass" href="/cart"><i class="fa-solid fa-bag-shopping fs-4"></i><span class="badge bg-danger rounded-pill">
                    </span></a>

                    <?php if ($_SESSION['user'] ?? false) : ?>
                        <a href="account.php" class="nav-link text-dark">
                            <i class="fa-solid fa-circle-user fs-4 align-text-bottom"></i>
                            
                            <?= htmlspecialchars($_SESSION['user']['username'] ?? 'Guest') ?>
                        </a>
                        <form method="POST" action="/session">
                            <input type="hidden" name="_method" value="DELETE"/>
                            <button class="nav-link text-dark text-uppercase">Log Out</button>
                        </form>
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



