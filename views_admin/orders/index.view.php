<?php require base_path('views_admin/partials/head.php') ?>

<div class="container-fluid px-4 mt-5">

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

    <h4><?= $heading ?></h4>

    <div class="card mt-5 border-0 shadow-sm">
        <div class="card-content">
            <div class="card-body p-4">
                <table class="table mt-4 text-center">
                    <thead class="bg-light border-bottom border-1 border-dark">
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Customer Name</th>
                            <th scope="col">Order Date</th>
                            <th scope="col">Total</th>
                            <th scope="col">Delivered</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($orders as $order) {
                            $badgeClass = $order['delivered'] === 1 ? 'success' : 'danger';
                            $badgeText = $order['delivered'] === 1 ? 'Yes' : 'No';
                        ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div>
                                        <p><?= htmlspecialchars($order['customer_name']); ?></p>
                                    </div>
                                </div>
                            </td>
                            <td><?= htmlspecialchars($order['order_date']); ?></td>
                            <td><?= htmlspecialchars($order['total_amount']); ?> MMK</td>
                            <td>
                                <a href="/admin/order/status?id=<?= $order['order_id']; ?>&current=<?= $order['delivered']; ?>">
                                    <span class="badge text-bg-<?= $badgeClass; ?> px-3">
                                        <?= $badgeText; ?>
                                    </span>
                                </a>
                            </td>
                            <td>
                                <a href="/admin/order/show?id=<?= $order['order_id']; ?>" class="text-decoration-none text-secondary"><i class="fa-solid fa-eye"></i></a>
                                <a href="#" class="text-decoration-none text-secondary" data-bs-toggle="modal" data-bs-target="#deleteOrderModal<?= $i; ?>"><i class="fa-solid fa-trash"></i></a>
                            </td>
                        </tr>
                        <?php
                        require "delete.view.php"; 
                        $i++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
</div>


<?php require base_path('views_admin/partials/footer.php') ?>
