<?php require('partials/head.php') ?>
<?php require('partials/nav.php') ?>
<?php require('partials/banner.php') ?>

<main>
    <div class="container my-5">
        <h4 class="fw-normal mb-3"><?= $cartCount ?> Items in Cart</h4>

        <?php if (!empty($_SESSION['id'])) : ?>
            <div class="row">
                <div class="col-md-9">
                    <?php foreach ($cartItems as $item) : ?>
                        <div class="card rounded-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <img src="images/<?= $item['product_img'] ?>" alt="" class="img-fluid">
                                    </div>
                                    <div class="col-sm-7">
                                        <p class="fw-bold mb-1"><?= $item['product_name'] ?></p>
                                        <p class="mb-2">By <a href="#" class="link-dark text-decoration-none"><?= $item['brand_name'] ?></a></p>
                                        <small class="d-inline-flex mb-1 px-2 fw-semibold text-warning bg-warning bg-opacity-10 border border-warning border-opacity-25"><?= $item['category_name'] ?></small>
                                        <small class="d-block">
                                            <i class="fa-solid fa-star color-1"></i>
                                            <i class="fa-solid fa-star color-1"></i>
                                            <i class="fa-solid fa-star color-1"></i>
                                            <i class="fa-solid fa-star-half-stroke color-1"></i>
                                        </small>
                                    </div>
                                    <div class="col-sm-2 text-center">
                                        <p class="fw-bold mb-3" style="color:#d09100;"><span class="text-secondary"><?= $item['quantity'] ?> x </span><?= $item['product_price'] ?> MMK</p>
                                        <button onclick="location.href = 'removeFromCart.php?id=<?= $item['shoppingcart_product_id'] ?>'" class="btn btn-outline-danger btn-sm rounded-0 removeFromCartBtn">Remove</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="col-md-3">
                    <h4 class="fw-normal mb-3">Total:</h4>
                    <h2 class="mb-3 fw-bold"><?= $tempTotal ?> MMK</h2>
                    <div class="d-grid gap-2">
                        <?php if ($tempTotal > 0) : ?>
                            <button class="rounded-0 secondary-btn shadow-sm btn py-3 fw-bold" type="Submit" onclick="location.href='checkout.php?cid=<?= $cartItems[0]['shoppingcart_id'] ?>'">Checkout</button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php else : ?>
            <p>Please log in to view your cart.</p>
        <?php endif; ?>
    </div>
</main>

<?php require('partials/footer.php') ?>




