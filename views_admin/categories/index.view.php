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
    <h4><?= $heading; ?></h4>

    <div class="card mt-5 border-0 shadow-sm">
        <div class="card-content">
            <div class="card-body p-4">
                <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#addCategoryModal">Add Category</button>

                <table class="table mt-4 text-center">
                    <thead class="bg-light border-bottom border-1 border-dark">
                        <tr>
                            <th>No.</th>
                            <th>Category Name</th>
                            <th>Category Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; foreach ($categories as $category) { ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td><?= $category['category_name']; ?></td>
                            <td><?= $category['category_description']; ?></td>
                            <td>
                                <a href="#" class="text-decoration-none text-secondary" data-bs-toggle="modal" data-bs-target="#deleteCategoryModal<?= $category['category_id']; ?>">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                                <a href="#" class="text-decoration-none text-secondary" data-bs-toggle="modal" data-bs-target="#editCategoryModal<?= $category['category_id']; ?>">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                            </td>
                        </tr>
                        <?php
                            require "delete.view.php";
                            require "edit.view.php";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php require "add.view.php"; ?>



<?php require base_path('views_admin/partials/footer.php') ?>
