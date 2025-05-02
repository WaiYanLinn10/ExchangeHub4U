<?php require('partials/head.php') ?>
<?php require('partials/nav.php') ?>
<?php require('partials/banner.php') ?>

<main>
    <div class="container my-5">

    <?php use Core\Session; ?>
    <?php if (Session::has('message')): ?>
        <?php list($type, $message) = Session::get('message'); ?>

        <!-- Ensure Bootstrap-friendly classes -->
        <div class="alert <?php echo ($type === 'success') ? 'alert-success' : 'alert-danger'; ?>" id="flashMessage">
            <?php echo $message; ?>
        </div>

        <?php Session::unflash(); // Remove message after displaying ?>
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
    
        <h4 class="fw-normal mb-3"><?= htmlspecialchars($cartCount) ?> Items in Cart</h4>

        <?php if (!empty($cartItems)) : ?>
            <div class="row">
                <div class="col-md-9">
                    <?php foreach ($cartItems as $item) : ?>
                        <div class="card rounded-0 mb-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <img src="images/products/<?= htmlspecialchars($item['product_img']) ?>" 
                                             alt="Product Image" class="img-fluid">
                                    </div>
                                    <div class="col-sm-7">
                                        <p class="fw-bold mb-1"><?= htmlspecialchars($item['product_name']) ?></p>
                                        <p class="mb-2">
                                            By <a href="#" class="link-dark text-decoration-none">
                                                <?= htmlspecialchars($item['brand_name']) ?>
                                            </a>
                                        </p>
                                        <small class="d-inline-flex mb-1 px-2 fw-semibold text-warning bg-warning bg-opacity-10 border border-warning border-opacity-25">
                                            <?= htmlspecialchars($item['category_name']) ?>
                                        </small>
                                    </div>
                                    <div class="col-sm-2 text-center">
                                        <p class="fw-bold mb-3" style="color:#d09100;">
                                            <span class="text-secondary"><?= htmlspecialchars($item['quantity']) ?> x </span>
                                            <?= number_format(htmlspecialchars($item['product_price']), 2) ?> MMK
                                        </p>

                                        <form action="/cart" method="POST">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="id" value="<?= htmlspecialchars($item['shoppingcart_product_id']) ?>">
                                               <button class="btn btn-outline-danger btn-sm rounded-0">
                                                Remove
                                            </button>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="col-md-3">
                    <h4 class="fw-normal mb-3">Total:</h4>
                    <h2 class="mb-3 fw-bold"><?= number_format(htmlspecialchars($tempTotal), 2) ?> MMK</h2>
                    <div class="d-grid gap-2">
                    <form action="/checkout" method="POST">
                        <?php foreach ($cartItems as $item): ?>
                            <input type="hidden" name="cart_items[]" value="<?= $item['product_id'] ?>">
                            <input type="hidden" name="cart_quantities[]" value="<?= $item['quantity'] ?>">
                        <?php endforeach; ?>
                        <button type="submit" class="btn btn-primary btn-lg rounded-pill shadow-sm fw-bold px-4 py-2">
                            <i class="fa-solid fa-credit-card me-2"></i> Checkout
                        </button>
                    </form>



                    </div>
                </div>
            </div>
        <?php else : ?>
            <p class="text-muted text-center fs-5 mt-4">
                Your shopping cart is empty. 
                <a href="/shop" class="text-primary fw-bold">Start shopping now</a>!
            </p>
        <?php endif; ?>
    </div>
</main>

<?php require('partials/footer.php') ?>
