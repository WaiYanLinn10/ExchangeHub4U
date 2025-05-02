<?php require base_path('views_admin/partials/head.php') ?>

<div class="container-fluid px-4 mt-5">
    <h4>Order Details</h4>

    <div class="card mt-5 border-0 shadow-sm">
        <div class="card-content">
            <div class="card-body p-4">
                <div class="container-fluid">
                    <div class="row">
                        <!-- ORDER SUMMARY -->
                        <div class="col-sm-4">
                            <!-- Order Summary Card -->
                            <div class="card rounded-0 shadow-sm border-0 mb-5">
                                <div class="card-header border-0 rounded-0 fw-bold" style="background-color: #eaeef1;">
                                    ORDER SUMMARY
                                </div>
                                <div class="card-body" style="background-color: #f8f9fa;">
                                    <p class="text-secondary">Shipping and additional costs are calculated based on values you have entered.</p>
                                    <ul class="list-group list-group-flush">
                                        <!-- Order Total -->
                                        <li class="list-group-item px-0 d-flex justify-content-between">
                                            <span>Order Total</span>
                                            <span><?= $orderDetails['total_amount'] - 2000; ?> MMK</span>
                                        </li>
                                        <!-- Shipping Fees -->
                                        <li class="list-group-item px-0 d-flex justify-content-between">
                                            <span>Shipping Fees</span>
                                            <span>2000 MMK</span>
                                        </li>
                                        <!-- Payment Method -->
                                        <li class="list-group-item px-0 d-flex justify-content-between">
                                            <span>Payment Method</span>
                                            <span><?= $orderDetails['payment_type']; ?></span>
                                        </li>
                                        <!-- Payment Total -->
                                        <li class="list-group-item px-0 d-flex justify-content-between">
                                            <span>Payment Total</span>
                                            <span><?= $orderDetails['total_amount']; ?> MMK</span>
                                        </li>
                                        <?php if ($orderDetails['payment_type_id'] != 2): ?>
                                            <li class="list-group-item px-0 d-flex justify-content-between">
                                                <span>Transaction no</span>
                                                <span><?= $orderDetails['transaction_no']; ?></span>
                                            </li>
                                        <?php endif; ?>

                                    </ul>
                                </div>
                            </div>

                            <!-- Shipping Address Card -->
                            <div class="card rounded-0 shadow-sm border-0">
                                <div class="card-header border-0 rounded-0 fw-bold" style="background-color: #eaeef1;">
                                    Shipping Address
                                </div>
                                <div class="card-body" style="background-color: #f8f9fa;">
                                    <p><?php echo $orderDetails['shipping_address']; ?></p>
                                </div>
                            </div>
                        </div>

                        <!-- PRODUCT DETAILS -->
                        <div class="col-sm-8">
                            <table class="table table-striped text-center">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($productDetails as $product):
                                    ?>
                                    <tr>
                                        <th scope="row"><?php echo $i; ?></th>
                                        <td>
                                            <div class="container-fluid">
                                                <div class="row">
                                                    <div class="col-3 px-0">
                                                        <img src="/../images/products/<?= $product['product_img']; ?>" class="img-fluid" style="height: 75px;" alt="Product Image">
                                                    </div>
                                                    <div class="col-9 d-flex align-items-center">
                                                        <p><?php echo $product['product_name']; ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td><?php echo $product['product_price']; ?> MMK</td>
                                        <td><?php echo $product['order_product_quantity']; ?></td>
                                        <td><?php echo $product['order_product_quantity'] * $product['product_price']; ?> MMK</td>
                                    </tr>
                                    <?php
                                    $i++;
                                    endforeach;
                                    ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require base_path('views_admin/partials/footer.php') ?>