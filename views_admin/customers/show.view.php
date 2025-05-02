<?php require base_path('views_admin/partials/head.php') ?>

<div class="container-fluid px-4 mt-5">
    <h4><?= $heading ?></h4>

    <div class="card mt-5 border-0 shadow-sm">
        <div class="card-content">
            <div class="card-body p-4">
                <div class="container-fluid">
                    <div class="row">
                        <!-- <div class="col-sm-4">
                            <img src="../images/profilepic/<?php echo $customer['customer_img'];?>" alt="" class="img-fluid">
                        </div> -->
                        <div class="col-sm-1"></div>
                        <div class="col-sm-7">
                            <h3 class="fw-bold"><?php echo $customer['customer_name'];?></h3>
                            <h5><span class="text-secondary fw-normal">Username :</span> <?php echo $customer['username'];?></h5>
                            <h6 class="fw-normal mb-5"><span class="text-secondary">Date :</span> <?php echo $customer['created_time'];?></h6>
                            <h6><span class="text-secondary fw-normal">Email :</span> <?php echo $customer['email'];?></h6>
                            <h6 class="mb-5"><span class="text-secondary fw-normal">Phone Num :</span> <?php echo $customer['customer_phone'];?></h6>                            <hr class="my-4">
                            <h6 class="fw-normal text-secondary fw-normal">Address</h6>
                            <p><?php echo $customer['customer_address'];?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require base_path('views_admin/partials/footer.php') ?>