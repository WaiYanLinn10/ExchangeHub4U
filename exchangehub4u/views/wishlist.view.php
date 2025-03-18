<?php require('partials/head.php') ?>
<?php require('partials/nav.php') ?>
<?php require('partials/banner.php') ?>



<main>
<div class="container my-5">
    <h4 class="fw-normal mb-3"><?= $wishlistCount ?> Items in Wishlist</h4>

    <?php if (!empty($_SESSION['id'])) { ?>
        <table class="table table-hover table-bordered">
            <?php $count = 1; while ($wishlistData = $wishlistResult->fetch_assoc()) { ?>
                <tr>
                    <th scope="row" style="width: 5%;" class="align-middle text-center">
                        <?= $count ?>
                    </th>
                    <td style="width:7%; padding:0px;">
                        <div class="overflow-hidden">
                            <a href="product.php?id=<?= $wishlistData['product_id'] ?>">
                                <img src="images/products/<?= $wishlistData['product_img'] ?>" alt="" class="img-fluid hvr-grow">
                            </a>
                        </div>
                    </td>
                    <td class="align-middle text-center" style="width: 44%;">
                        <h5 class="text-center fw-bold">
                            <a href="product.php?id=<?= $wishlistData['product_id'] ?>" class="text-decoration-none link-dark">
                                <?= $wishlistData['product_name'] ?>
                            </a>
                        </h5>
                        <h6 class="mt-1 text-center" style="color:#d09100;"><?= $wishlistData['product_price'] ?> MMK</h6>
                        <?php if ($wishlistData['product_quantity'] != 0) { ?>
                            <h6 class="mt-1 text-center text-success text-opacity-75">In Stock!</h6>
                        <?php } else { ?>
                            <h6 class="mt-1 text-center text-danger text-opacity-75">Out Of Stock!</h6>
                        <?php } ?>
                    </td>
                    <td class="align-middle text-center" style="width: 44%;">
                        <a class="btn secondary-btn rounded-0 fw-bold" href="addProductToCart.php?id=<?= $wishlistData['product_id'] ?>&quantity=1&wishlist=<?= $wishlistData['wishlist_product_id'] ?>" style="border: 1px solid;">ADD TO CART</a> <br>
                        <a href="removeFromWishlist.php?id=<?= $wishlistData['wishlist_product_id'] ?>" class="link-secondary">Remove</a>
                    </td>
                </tr>
            <?php $count++; } ?>
        </table>
    <?php } ?>
</div>
</main>


<?php require('partials/footer.php') ?>


