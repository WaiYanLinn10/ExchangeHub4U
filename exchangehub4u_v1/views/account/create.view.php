<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/nav.php') ?>
<div class="container my-5 py-5">
    <div class="col-md-6 mx-auto">
        <div class="card shadow-sm rounded-0 p-3 pb-4">
            <div class="card-body">
                <h1 class="text-center fw-light color-1"><?= $heading; ?></h1>
                <form action="/account" method="POST" enctype="multipart/form-data">
                <ul class="list-unstyled">

                    <div class="form-floating mt-2">
                        <input type="text" class="form-control rounded-0" id="fullname" name="fullname" placeholder="name@example.com" required>
                        <label for="fullname">Fullname</label>
                    </div>
                    <?php if (isset($errors['fullname'])) : ?>
                        <li class="alert alert-danger mt-2"><?= $errors['fullname'] ?></li>
                    <?php endif; ?>

                    <div class="form-floating mt-2">
                        <input type="number" class="form-control rounded-0" id="phonenum" placeholder="name@example.com" name="phonenum" required>
                        <label for="phonenum">Phone Number</label>
                    </div>
                    <?php if (isset($errors['phonenum'])) : ?>
                        <li class="alert alert-danger mt-2"><?= $errors['phonenum'] ?></li>
                    <?php endif; ?>

                    <div class="form-floating mt-2">
                        <textarea class="form-control rounded-0" placeholder="Leave a comment here" id="address" style="height: 150px" name="address" required></textarea>
                        <label for="address">Detail Address</label>
                    </div>
                    <?php if (isset($errors['address'])) : ?>
                        <li class="alert alert-danger mt-2"><?= $errors['address'] ?></li>
                    <?php endif; ?>
                    
                    </ul>
                    <div class="d-grid gap-2 mt-4">
                        <button class="btn btn-dark rounded-0 py-2" type="submit">Save</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<?php require base_path('views/partials/footer.php') ?>