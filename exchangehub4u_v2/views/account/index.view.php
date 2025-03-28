<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/nav.php') ?>


<div  style="height: 52px; background-color: #efaa083e;">
    <div class="container">
        <div class="row h-100 align-items-center">
            <div class="col-7 text-dark p-3">
                <p class="d-inline p-2">
                    <a class="link-secondary color-1 text-decoration-none" href="/">Home</a><span> - My Account</span>
                </p>
            </div>
        </div>
    </div>
</div>

<?php use Core\Session; ?>
<?php if (Session::has('message')): ?>
    <?php list($type, $message) = Session::get('message'); ?>
    <div class="alert alert-<?php echo $type; ?>" id="flashMessage">
        <?php echo $message; ?>
    </div>
    <?php Session::unflash(); // Remove the message after displaying ?>
<?php endif; ?>

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


<div class="container">
    <h1 class="text-uppercase my-5" style="color:#f8cb1e;">My Account</h1>
    <div class="row my-5">
        <div class="col-md-2 pt-3">
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <button class="nav-link rounded-0 text-start mb-2 active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true"><i class="fa-solid fa-circle-user"></i> &nbsp;My details</button>
                <button class="nav-link rounded-0 text-start mb-2" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false"><i class="fa-solid fa-unlock"></i> &nbsp; Security</button>
                <button class="nav-link rounded-0 text-start mb-2" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false"><i class="fa-solid fa-bag-shopping"></i> &nbsp; My orders</button>
                <button class="nav-link rounded-0 text-start mb-2" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false"><i class="fa-solid fa-circle-question"></i> &nbsp; My questions</button>
            </div>
        </div>

        <div class="col-md-10 px-4">

            <div class="card rounded-0 shadow-sm">

                <div class="card-body p-5">

                    <div class="tab-content" id="v-pills-tabContent">

                        <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab" tabindex="0">

                            <h2>My details</h2>

                            <h5 class="mt-5 pb-2 border-bottom border-2">Personal Information</h5>

                            <div class="row mt-4">
                                <div class="col-sm-4 pe-3">
                                    <p>This is the your personal information. You can make changes expect from the username.</p>
                                </div>
                                <div class="col-sm-8">
                                    <div class="row">
                                        <div class="col-sm-6 mb-4">
                                            <label class="fw-semibold mb-2">USER NAME</label>
                                            <input type="text" class="form-control py-2 rounded-0" value="<?= $user['username']; ?>" disabled>
                                        </div>
                                        <div class="col-sm-6 mb-4">
                                            <label class="fw-semibold mb-2">FULLNAME</label>
                                            <input type="text" class="form-control py-2 rounded-0" value="<?= $user['customer_name']; ?>" disabled>
                                        </div>
                                    </div>
                                    <!-- <div class="row">
                                        <div class="col-sm-6">
                                            <label class="fw-semibold mb-2">PROFILE IMAGE</label>
                                            <div class="w-100 bg-dark bg-opacity-50">
                                                <img src="images/profilepic/image1" alt="" style="height: 170px;" class="img-fluid d-block mx-auto">
                                            </div>
                                        </div>
                                    </div>
                                        -->
                                </div>
                            </div>

                            <h5 class="mt-5 pb-2 border-bottom border-2">Contact Information</h5>

                            <div class="row mt-4">
                                <div class="col-sm-4 pe-3">
                                    <p>This is your contact information. Please let us know your exact contact information to have the faster delivery process. </p>
                                </div>
                                <div class="col-sm-8">
                                    <div class="row">
                                        <div class="col-sm-6 mb-4">
                                            <label class="fw-semibold mb-2">PHONE NUMBER</label>
                                            <input type="text" class="form-control py-2 rounded-0" value="<?php echo $user['customer_phone'];?>" disabled>
                                        </div>
                                        <div class="col-sm-6 mb-4">
                                            <label class="fw-semibold mb-2">EMAIL</label>
                                            <input type="text" class="form-control py-2 rounded-0" value="<?php echo $user['email'];?>" disabled>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <label class="fw-semibold mb-2">DETAILS ADDRESS</label>
                                            <textarea class="form-control rounded-0" rows="5" disabled><?php echo $user['customer_address'];?></textarea>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>

                            <button class="btn btn-warning float-end rounded-0 px-4 mt-4" data-bs-toggle="modal" data-bs-target="#editMyDetailsModal">Edit</button>

                                
                        </div>

                        <div class="modal fade" id="editMyDetailsModal" tabindex="-1" aria-labelledby="editMyDetailsModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                <div class="modal-content p-5 rounded-0">
                                    <h2 class="text-center mb-4">Edit My Details</h2>
                                    <form action="/account/update/info" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="_method" value="PATCH">
                                    <input type="hidden" name="id" value="<?= $user['user_id'] ?>">
                                        <div class="row">
                                            <div class="col-sm-6 mb-4">
                                                <label class="fw-semibold mb-2">USER NAME</label>
                                                <input type="text" name="username" class="form-control py-2 rounded-0  bg-secondary bg-opacity-25" value="<?= $user['username'];?>" disabled>
                                                <small class="text-muted">Username cannot be change. If you want to change the username, you can contact the admin for help.</small>
                                            </div>
                                            <div class="col-sm-6 mb-4">
                                                <label class="fw-semibold mb-2">FULLNAME</label>
                                                <input type="text" name="full_name" class="form-control py-2 rounded-0  bg-secondary bg-opacity-25" value="<?= $user['customer_name'];?>" required>
                                            </div>
                                        </div>
                                        <!-- <div class="row">
                                            <div class="col-sm-6 mb-4">
                                                <label class="fw-semibold mb-2">PROFILE IMAGE</label>
                                                <div class="w-100 bg-dark bg-opacity-50">
                                                    <img src="images/profilepic/image" alt="" style="height: 170px;" class="img-fluid d-block mx-auto">
                                                    <input type="file" name="customer_img" class="form-control rounded-0  bg-secondary bg-opacity-25">
                                                </div>
                                            </div>
                                        </div> -->
                                        <div class="row">
                                            <div class="col-sm-6 mb-4">
                                                <label class="fw-semibold mb-2">PHONE NUMBER</label>
                                                <input type="text" class="form-control py-2 rounded-0  bg-secondary bg-opacity-25" name="phone" value="<?= $user['customer_phone'];?>" required>
                                            </div>
                                            <div class="col-sm-6 mb-4">
                                                <label class="fw-semibold mb-2">EMAIL</label>
                                                <input type="text" class="form-control py-2 rounded-0  bg-secondary bg-opacity-25" name="email" value="<?= $user['email'];?>" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 mb-4">
                                                <label class="fw-semibold mb-2">DETAILS ADDRESS</label>
                                                <textarea name="address" rows="5" class="form-control p-2 rounded-0 bg-secondary  px-3 bg-opacity-25" required><?= $user['customer_address'];?></textarea>
                                            </div>
                                        </div>

                                        
                                        <button type="submit" class="btn btn-warning float-end rounded-0">Save Changes</button>
                                        <button type="button" class="btn btn-secondary mx-3 px-4 float-end rounded-0" data-bs-dismiss="modal">Close</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab" tabindex="0">
                            <h2>My security</h2>

                            <h5 class="mt-5 pb-2 border-bottom border-2">Password Information</h5>

                            <form action="/account/update/pwd" method="POST">
                            <input type="hidden" name="_method" value="PATCH">
                            <input type="hidden" name="id" value="<?= $user['user_id'] ?>">
                            <div class="row mt-4">
                                <div class="col-sm-4 pe-3">
                                    <p>You can upgrade your account security by changing your passwords here. Make sure not to forget your passwords.</p>
                                </div>
                                
                                <div class="col-sm-8">
                                    <div class="row">
                                        <div class="col-sm-12 mb-4">
                                            <label class="fw-semibold mb-2">Old Password</label>
                                            <input type="password" name="oldPwd" class="form-control rounded-0 py-2" required>
                                        </div>
                                        <div class="col-sm-12 mb-4">
                                            <label class="fw-semibold mb-2">New Password</label>
                                            <input type="password" name="newPwd" class="form-control rounded-0 py-2" required>
                                        </div>
                                        <div class="col-sm-12 mb-4">
                                            <label class="fw-semibold mb-2">Confirm Password</label>
                                            <input type="password" name="confirmPwd" class="form-control rounded-0 py-2" required>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>

                            <button class="btn btn-warning float-end rounded-0 px-4 mt-3" type="submit">Save Changes</button>
                            </form>

                        </div>

                    </div>

                </div>

            </div>

        </div>
    </div>
</div>


<?php require base_path('views/partials/footer.php') ?>