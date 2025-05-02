<?php require base_path('views_admin/partials/head.php') ?>

<div class="container-fluid px-4 mt-5">
    <h4>Product Details</h4>

    <div class="card mt-5 border-0 shadow-sm">
        <div class="card-content">
            <div class="card-body p-4">
                <div class="container-fluid">
                    <div class="row">

                        <div class="col-sm-4">
                            <img src="/../images/products/<?php echo $productDetails['product_img']; ?>" alt="" class="img-fluid">
                            <div class="row mt-4">
                                <div class="col-sm-6">
                                    <h6 class="fw-normal text-secondary">Category:</h6>
                                    <strong><?php echo $productDetails['category_name']; ?></strong>
                                </div>
                                <div class="col-sm-6">
                                    <h6 class="fw-normal text-secondary">Brand:</h6>
                                    <strong><?php echo $productDetails['brand_name']; ?></strong>
                                </div>
                            </div>
                        </div>


                        <div class="col-sm-1"></div>


                        <div class="col-sm-7">
                            <h3 class="fw-bold"><?php echo $productDetails['product_name']; ?></h3>
                            <h6 class="fw-normal text-secondary">Added Date: <?php echo $productDetails['product_add_date']; ?></h6>
                            <p class="mb-5">
                            </p>
                            <h6 class="fw-normal text-secondary">Retail Price:</h6>
                            <h4 class="mb-5"><?php echo $productDetails['product_price']; ?> MMK</h4>
                            <h6 class="fw-normal text-secondary">Description</h6>
                            <p><?php echo $productDetails['product_description']; ?></p>
                            <hr class="my-4">
                            <div class="row">
                                <div class="col-sm-4">
                                    <h6 class="fw-normal text-secondary">Available Quantity:</h6>
                                    <strong><?php echo $productDetails['product_quantity']; ?></strong>
                                </div>

                              
                                <!-- <div class="col-sm-4">
                                    <h6 class="fw-normal text-secondary">Total Orders:</h6>
                                    <strong>0</strong>
                                </div>
                                <div class="col-sm-4">
                                    <h6 class="fw-normal text-secondary">Revenue:</h6>
                                    <strong>0 MMK</strong>
                                </div> -->
                     
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require base_path('views_admin/partials/footer.php') ?>