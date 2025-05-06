<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/nav.php') ?>

<head>
    <div  style="height: 52px; background-color: #A8D5E3;">
        <div class="container">
            <div class="row h-100 align-items-center">
                <div class="col-7 text-dark p-3">
                    <p class="d-inline p-2">
                        <a class="link-secondary color-1 text-decoration-none" href="/">Home</a>
                        <span> - </span>
                        <a class="link-secondary color-1 text-decoration-none" href="/shop">Shop</a>
                        <span> - </span>
                        <?= $heading ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</head>



<main>

    <div class="container mt-3">
        
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

        <div class="row mt-5">
            <div class="col-md-5">
                <img src="images/products/<?= $productData['product_img'] ?? 'image1.jpg'; ?>" alt="" class="img-fluid">
            </div>
            <div class="col-md-7">
                <div class="container">
                    <h1><?= $productData['product_name'];?></h1>
                    <h3 style="color:#7FBACD;"><?= $productData['product_price'];?> MMK</h3>
                    <hr class="my-5">
                    <h6 class="mb-4">Availability : 
                        <?php if($productData['product_quantity'] > 0){ ?>
                            <span class="text-success">In Stock!</span>
                        <?php }else {?>
                            <span class="text-danger">Out of Stock!</span>
                        <?php } ?>
                    </h6>
                    <form action="/cart" method="POST">
                        <div class="input-group align-items-center mb-4">
                            <h6>Quantity &nbsp;&nbsp;&nbsp;</h6>  
                            <span class="input-group-prepend">
                                <button type="button" id="minusQuantBtn" class="btn btn-outline-secondary rounded-0 btn-number border-end-0">
                                    <span class="fa fa-minus"></span>
                                </button>
                            </span>
                            <input type="text" name="quantity" id="quantity" class="form-control border-secondary bg-white border-start-0 border-end-0 input-number text-center" value="1" min="1" max="10" style="max-width:65px">
                            <span class="input-group-append">
                                <button type="button" class="btn  btn-outline-secondary border-start-0 rounded-0 btn-number" id="plusQuantBtn">
                                    <span class="fa fa-plus"></span>
                                </button>
                            </span>
                            <input type="hidden" name="id" value="<?php echo  $productData['product_id'];?>">
                        </div>
                        <div class="row w-100">
                            <div class="col-sm-11">
                                <div class="d-grid gap-2">
                                <?php if($productData['product_quantity'] > 0){ ?>
                                    <button type="submit" class="btn secondary-btn btn-lg rounded-0 fw-bold" style="border: 1px solid;">ADD TO CART</button>
                                <?php } else { ?>
                                    <button type="button" class="btn secondary-btn btn-lg rounded-0 fw-bold" style="border: 1px solid;">ADD TO CART</button>
                                <?php } ?>
                                </div>
                            </div>
                    </form>

                        <div class="col-sm-1">
                            <div class="d-grid gap-2">
                            <form action="/wishlist" method="POST">
                                <input type="hidden" name="product_id" value="<?= $productData['product_id']; ?>">
                                <button type="submit" class="btn btn-outline-danger btn-lg rounded-0 fw-bold">
                                    <i class="fa-solid fa-heart"></i>
                                </button>
                            </form>


                            </div>
                        </div>
                    </div>

                    
                    <hr class="my-5">

                    <h6>
                        Category : &nbsp;<a href="#" class="link-secondary fw-normal text-decoration-none"><?php echo $productData['category_name'];?></a>
                    </h6>
                    <h6 class="mt-4">
                        Share : &nbsp;<p style="letter-spacing:4px;" class="d-inline">
                        <a href="https://facebook.com" class="text-decoration-none"><i class="fa-brands fa-square-facebook link-dark"></i></a>
                        <a href="https://instagram.com" class="text-decoration-none"><i class="fa-brands fa-instagram link-dark"></i></a>
                        <a href="https://linkedin.com" class="text-decoration-none"><i class="fa-brands fa-facebook-messenger link-dark"></i></a>
                        <a href="https://messenger.com" class="text-decoration-none"><i class="fa-brands fa-telegram link-dark"></i></a>
                    </p>
                    </h6>

                    <h4 class="mt-5 mb-3">Product Description</h4>

                    <p> <?= $productData['product_description'];?>
                        <!-- <?php
                        $data = $productData['product_description'];

                        $items = explode(' - ', $data);

                        // Display each item on a new line
                        foreach ($items as $item) {
                            echo trim($item) . "<br>"; // Use trim() to remove extra spaces
                        }
                        ?> -->
                    </p>
                    
                    
                </div>
                
            </div>
        </div>
    </div>

    <hr class="my-5">

</main>


<script>
    document.addEventListener("DOMContentLoaded", function () {
        let quantityInput = document.getElementById("quantity");
        let minusBtn = document.getElementById("minusQuantBtn");
        let plusBtn = document.getElementById("plusQuantBtn");

        minusBtn.addEventListener("click", function () {
            let value = parseInt(quantityInput.value, 10);
            if (value > 1) {
                quantityInput.value = value - 1;
            }
        });

        plusBtn.addEventListener("click", function () {
            let value = parseInt(quantityInput.value, 10);
            let max = parseInt(quantityInput.getAttribute("max"), 10) || 10;
            if (value < max) {
                quantityInput.value = value + 1;
            }
        });

        // Ensure input only accepts valid numbers
        quantityInput.addEventListener("input", function () {
            let value = parseInt(this.value, 10);
            if (isNaN(value) || value < 1) {
                this.value = 1;
            } else if (value > 10) {
                this.value = 10;
            }
        });
    });
</script>

<?php require base_path('views/partials/footer.php') ?>