<?php require base_path('views_admin/partials/head.php') ?>
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

<div class="container-fluid px-4 mt-5">
    <h4>Questions And Answers</h4>

    <div class="card mt-5 border-0 shadow-sm">
        <div class="card-content">
            <div class="card-body p-4">
                <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#addFAQModal">Add Q&A</button>
                <div class="table-responsive">
                    <table class="table mt-4 text-center">
                        <thead class="bg-light border-bottom border-1 border-dark">
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Question</th>
                                <th scope="col">Answer</th>
                                <th scope="col">Mark as FAQ</th>
                                <th scope="col">Asked By</th>
                                <th scope="col">Asked Time</th>
                                <th scope="col">Answered By</th>
                                <th scope="col">Answered Time</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($faqs as $faq) {
                                $badgeClass = $faq['posted'] === 1 ? 'success' : 'danger';
                                $badgeText = $faq['posted'] === 1 ? 'Yes' : 'No';
                                ?>
                                <tr>
                                    <th scope="row"><?= $i ?></th>
                                    <td><?= htmlspecialchars($faq['faq_question']) ?></td>  
                                    <td><?= empty($faq['faq_answer']) ? '-' : htmlspecialchars($faq['faq_answer']) ?></td>
                                    <td>
                                        <a href="/admin/faq/status?id=<?=$faq['faq_id']; ?>&current=<?=$faq['posted']; ?>">
                                            <span class="badge text-bg-<?= $badgeClass; ?> px-3">
                                                <?= $badgeText; ?>
                                            </span>
                                        </a>
                                    </td>                                    
                                    <td><?= getCustomerName($db, $faq['customer_id']) ?></td>
                                    <td><?= htmlspecialchars($faq['created_time']) ?></td>
                                    <td><?= getAdminName($db, $faq['admin_id']) ?></td>
                                    <td><?= empty($faq['answer_time']) ? '-' : htmlspecialchars($faq['answer_time']) ?></td>
                                    <td>
                                        <a class="text-decoration-none text-secondary mx-2" href="#" data-bs-toggle="modal" data-bs-target="#answerFAQModal<?= $faq['faq_id'] ?>">Answer</a>
                                        <a href="#" class="text-decoration-none text-secondary" data-bs-toggle="modal" data-bs-target="#deleteFAQModal<?= $faq['faq_id'] ?>"><i class="fa-solid fa-trash"></i></a>
                                    </td>
                                </tr>
                                <?php
                                require "answer.view.php";
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
</div>

<?php require "add.view.php"; ?>

<?php require base_path('views_admin/partials/footer.php') ?>