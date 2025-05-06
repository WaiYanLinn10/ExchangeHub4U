<?php require('partials/head.php') ?>
<?php

    use Core\Session;
 

    // Display flash messages
    if (Session::has('_flash')) {
        // Iterate through each flash message
        foreach ($_SESSION['_flash'] as $key => $message) {
            if ($key == 'success') {
                echo "<div id='flashMessage' class='alert alert-success'>$message</div>";
            } elseif ($key == 'fail') {
                echo "<div id='flashMessage' class='alert alert-danger'>$message</div>";
            }
            
        }
        // Clear flash messages after displaying
        Session::unflash();

        

    }
 
    $current = date("Y");
    $totalSales = [];

    for ($i = 1; $i <= 12; $i++) {
        $sale = 0;
        $startDate = "$current-$i-01";
        $endDate = "$current-$i-31";

        // Use the Database class to execute the query
        $sql = "SELECT total_amount FROM payment WHERE payment_time BETWEEN :startDate AND :endDate";
        $params = ['startDate' => $startDate, 'endDate' => $endDate];
        $results = $db->query($sql, $params)->get();

        // Calculate the total sales for the month
        foreach ($results as $data) {
            $sale += $data['total_amount'];
        }

        array_push($totalSales, $sale);
    }

    
?>

<script>
    // Auto-hide the flash message after 3 seconds
    setTimeout(function() {
        let alert = document.getElementById('flashMessage');
        if (alert) {
            alert.style.transition = "opacity 0.5s";
            alert.style.opacity = "0";
            setTimeout(() => alert.remove(), 500);
        }
    }, 3000); // 3 seconds
</script>

<div class="container-fluid px-4 mt-5">
    <h4><?= $heading?></h4>
    <div class="row my-4">

        <div class="col-sm-4">
            <div class="card shadow-sm bg-light text-center py-4">
                <h5>Total Income</h5>
                <h2 class = "text-success"><?php echo array_sum($totalSales); ?> MMK</h2>
            </div>

        </div>
        <div class="col-sm-4">
            <div class="card shadow-sm bg-light text-center py-4">
                <h5>Total Orders</h5>
                <h2><?php echo $totalOrders; ?></h2>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card shadow-sm bg-light text-center py-4">
                <h5>Total Customers</h5>
                <h2><?php echo $totalCustomers; ?></h2>
            </div>
        </div>
        


    </div>

    <div class="my-5 card shadow-sm">
        <div class="card-body">
            <h3>Income Statistics</h3>
            <canvas id="incomeChart" style="width:100%;"></canvas>
        </div>
    </div>
    
   
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        var ctx = document.getElementById('incomeChart').getContext('2d');
        var incomeChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    data: [
                        <?php echo implode(',', $totalSales); ?>
                    ],
                    label: 'Income',
                    backgroundColor: '#198754',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
    </script>
    
    <div class="card my-5 shadow-sm">
        <div class="card-body">
            <h3 class="mb-5">Latest Products</h3>
            <?php foreach ($latestProducts as $latestProd) { ?>
            <div class="row mb-3">
                <div class="col-sm-2 text-center px-0 mb-2">
                    <img src="../images/products/<?php echo $latestProd['product_img']; ?>" alt="" class="img-fluid" style="height: 100px;"> 
                </div>
                <div class="col-sm-2 ps-0 mb-2 pt-3">
                    <h6>Product Name</h6>
                    <p><?php echo $latestProd['product_name']; ?></p>
                </div>
                <div class="col-sm-2 mb-2 pt-3">
                    <h6>Quantity</h6>
                    <p><?php echo $latestProd['product_quantity']; ?></p>
                </div>
                <div class="col-sm-2 mb-2 pt-3">
                    <h6>Price</h6>
                    <p><?php echo $latestProd['product_price']; ?></p>
                </div>
                <div class="col-sm-2 mb-2 pt-3">
                    <h6>Brand</h6>
                    <p><?php echo $latestProd['brand_name']; ?></p>
                </div>
                <div class="col-sm-2 mb-2 pt-3">
                    <h6>Action</h6>
                    <a href="/admin/product/show?id=<?php echo $latestProd['product_id']; ?>" class="text-decoration-none text-secondary"><i class="fa-solid fa-eye"></i></a>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>

    <div class="card mt-5 shadow-sm">
        <div class="card-body">
            <h3 class="mb-5">Last Orders</h3>
            <div class="table-responsive">
                <table class="table table-hover table-borderless">
                    <thead class="bg-dark shadow-sm text-white">
                        <tr>
                            <th scope="col" class="text-center py-3 rounded-start">No.</th>
                            <th scope="col" class="text-center py-3">Customer Name</th>
                            <th scope="col" class="text-center py-3">Order Date</th>
                            <th scope="col" class="text-center py-3">Total</th>
                            <th scope="col" class="text-center py-3 rounded-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; foreach ($lastOrders as $lastOrder) { ?>
                        <tr>
                            <td scope="row" class="text-center py-3 rounded-start"><?php echo $i++; ?></td>
                            <td class="text-center">
                                <div class=" text-center">
                                    <div>
                                        <p class="mb-0"><?php echo $lastOrder['customer_name']; ?></p>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center py-3"><?php echo $lastOrder['order_date']; ?></td>
                            <td class="text-center py-3"><?php echo $lastOrder['total_amount']; ?> MMK</td>
                            <td class="text-center py-3 rounded-end">
                                <a href="/admin/order/show?id=<?php echo $lastOrder['order_id']; ?>" class="text-decoration-none text-secondary"><i class="fa-solid fa-eye"></i></a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    
   

</div>



<?php require('partials/footer.php') ?>

