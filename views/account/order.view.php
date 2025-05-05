<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/nav.php') ?>

<div  style="height: 52px; background-color: #A8D5E3;">
    <div class="container">
        <div class="row h-100 align-items-center">
            <div class="col-7 text-dark p-3">
                <p class="d-inline p-2">
                    <a class="link-secondary color-1 text-decoration-none" href="/">Home</a>
                    <span> - </span>
                    <a class="link-secondary color-1 text-decoration-none" href="/account/index">My Account</a>
                    <span> - My Order</span>
                </p>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <!-- Order Summary Section -->
    <div class="col-sm-4">
        <div class="card rounded-0 shadow-sm border-0 mb-5">
            <div class="card-header border-0 rounded-0 fw-bold bg-light">
                ORDER SUMMARY
            </div>
            <div class="card-body bg-light">
                <p class="text-secondary">Shipping and additional costs are calculated based on values you have entered.</p>
                <ul class="list-group list-group-flush">
                    <?php 
                    // Define order summary data in an associative array
                    $orderSummary = [
                        'Order Date' => date("jS M Y", strtotime($order['order_date'])),
                        'Order Total' => ($order['total_amount'] - 2000) . ' MMK',
                        'Shipping Fees' => '2000 MMK',
                        'Payment Method' => $order['payment_type'],
                        'Payment Total' => $order['total_amount'] . ' MMK',
                    ];

                    // Loop through the order summary and display each item
                    foreach ($orderSummary as $label => $value) {
                        echo "<li class='list-group-item px-0 d-flex justify-content-between bg-light'>
                                <span>$label</span>
                                <span>$value</span>
                              </li>";
                    }

                    ?>
                </ul>
            </div>
        </div>
        
        <!-- Shipping Address Section -->
        <div class="card rounded-0 shadow-sm border-0">
            <div class="card-header border-0 rounded-0 fw-bold bg-light">
                Shipping Address
            </div>
            <div class="card-body bg-light">
                <p><?php echo $order['shipping_address']; ?></p>
            </div>
        </div>
    </div>

    <!-- Products Table Section -->
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
                // Check if $order['products'] is valid and not empty
                if (!empty($orderProducts)) {
                    $mergedProducts = [];

                    // Merge quantities for the same product
                    foreach ($orderProducts as $product) {
                        if (isset($mergedProducts[$product['product_name']])) {
                            $mergedProducts[$product['product_name']]['order_product_quantity'] += $product['order_product_quantity'];
                        } else {
                            $mergedProducts[$product['product_name']] = $product;
                        }
                    }

                    foreach ($mergedProducts as $product) { ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= $product['product_name'] ?></td>
                            <td><?= $product['product_price'] ?></td>
                            <td><?= $product['order_product_quantity'] ?></td>
                            <td><?= $product['product_price'] * $product['order_product_quantity'] ?></td>
                        </tr>
                    <?php }
                } else { ?>
                    <tr>
                        <td colspan="5">No products found.</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>


<?php require base_path('views/partials/footer.php') ?>
