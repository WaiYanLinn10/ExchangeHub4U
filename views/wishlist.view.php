<?php require('partials/head.php'); ?>
<?php require('partials/nav.php'); ?>
<?php require('partials/banner.php'); ?>

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

        <h4 class="fw-normal mb-3"><?= $wishlistCount ?> Items in Wishlist</h4>

        <?php if ($wishlistCount > 0): ?>
            <table class="table table-hover table-bordered">
                <?php foreach ($wishlistItems as $index => $wishlistData): ?>
                    <tr>
                        <th scope="row" style="width: 5%;" class="align-middle text-center">
                            <?= $index + 1 ?>
                        </th>
                        <td style="width:15%; padding:0px;">
                            <div class="overflow-hidden">
                                <a href="/product?id=<?= $wishlistData['product_id'] ?>">
                                    <img src="images/products/<?= htmlspecialchars($wishlistData['product_img']) ?>" alt="" class="img-fluid hvr-grow">
                                </a>
                            </div>
                        </td>
                        <td class="align-middle text-center" style="width: 50%;">
                            <h5 class="text-center fw-bold">
                                <a href="/product?id=<?= $wishlistData['product_id'] ?>" class="text-decoration-none link-dark">
                                    <?= htmlspecialchars($wishlistData['product_name']) ?>
                                </a>
                            </h5>
                            <h6 class="mt-1 text-center" style="color:#d09100;">
                                <?= htmlspecialchars($wishlistData['product_price']) ?> MMK
                            </h6>
                            <h6 class="mt-1 text-center <?= $wishlistData['product_quantity'] > 0 ? 'text-success' : 'text-danger' ?> text-opacity-75">
                                <?= $wishlistData['product_quantity'] > 0 ? 'In Stock!' : 'Out Of Stock!' ?>
                            </h6>
                        </td>
                        <td class="align-middle text-center" style="width: 15%;">
                        <form action="/cart" method="POST">  
                            <input type="hidden" name="id" value="<?= $wishlistData['product_id']; ?>">
                            <input type="hidden" name="wishlist" value="<?= $wishlistData['wishlist_product_id']; ?>">  <!-- Pass Wishlist ID -->
                            <button type="submit" class="btn btn-outline-primary btn-lg rounded-0 fw-bold">
                                <i class="fa-solid fa-cart-plus"></i> 
                            </button>
                        </form>
                      
                        </td>
                        <td class="align-middle text-center" style="width: 15%;">
                            <form action="/wishlist" method="POST">
                                <input type="hidden" name="_method" value="DELETE">    
                                <input type="hidden" name="id" value="<?= $wishlistData['wishlist_product_id'] ?>">
                                <button type="submit" class="btn btn-outline-danger btn-lg rounded-0 fw-bold">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </td>


                    </tr>
                <?php endforeach; ?>
            </table>
        <?php else : ?>
            <p class="text-muted text-center fs-5 mt-4">
                Your Wishlist is empty. 
                <a href="/shop" class="text-primary fw-bold">Explore now</a>!
            </p>
        <?php endif; ?>
    </div>
</main>

<?php require('partials/footer.php'); ?>
