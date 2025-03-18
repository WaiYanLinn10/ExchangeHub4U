<?php require('partials/head.php') ?>
<?php require('partials/nav.php') ?>
<?php require('partials/banner.main.php') ?>

<main>
    <!-- <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <p>Hello, <?= $_SESSION['user']['email'] ?? 'Guest' ?>. Welcome to the home page.</p>
    </div> -->

    <div class="container mt-5">
        <div class="row mt-4">
            <div class="col-md-6 p-5 d-flex align-items-center">
                <div>
                    <h3 class="fw-light color-1"></h3>
                    <h1>Browse Electronic Devices</h1>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae porro debitis libero, tempora consectetur nam, mollitia doloribus hic dignissimos praesentium impedit consequuntur architecto et dolores nesciunt rem! Non, atque consectetur?</p>
                    <a href="/shop" class="rounded-0 secondary-btn">BUY NOW</a>
                </div>
            </div>

            <div class="col-md-6 py-5">
                <img src="images/image1.jpg" style="filter:brightness(97%);"class="img-fluid" alt="">
            </div>

        </div>
    </div>

    <div class="primary-bg mt-5">
        <div class="container py-5">
            <h4 class="fw-light text-center">TRENDING</h4>
            <h1 class="border-bottom mx-auto pb-2 text-uppercase" style="width: fit-content;">Latest Products</h1>
           
            <div class="row mt-3">
                <?php foreach ($latestProducts as $latestProds) : ?>
                    <div class="col-md-4 mx-auto mt-5">
                        <div class="overflow-hidden" style="height:400px;">
                            <img src="images/<?= $latestProds['product_img'] ?>" alt="" class="img-fluid hvr-grow h-100">
                        </div>
                        <h5 class="mt-3 text-center"><?= $latestProds['product_price'] ?> MMK</h5>
                        <h4 class="mt-2 text-center fw-bold"><?= $latestProds['product_name'] ?></h4>
                        <div class="text-center">
                            <a href="/product?id=<?= $latestProds['product_id'] ?>" class="btn rounded-0 secondary-btn">DETAILS</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            
        </div>
    </div>


</main>


<?php require('partials/footer.php') ?>
