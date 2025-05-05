<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <form action="/admin/user" method="POST" enctype="multipart/form-data">
                <div class="modal-header border-0">
                    <h5 class="modal-title" id="addUserModalLabel">Add User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            
                        <div class="mb-3">
                            <input type="text" class="form-control rounded-0" name="username" placeholder="Username" required>
                        </div>

                        <div class="mb-3">
                            <input type="email" class="form-control rounded-0" name="email" placeholder="Email" required>
                        </div>

                        <div class="mb-3">
                            <input type="password" class="form-control rounded-0" id="password" name="password" placeholder="Password" required>
                        </div>
                    
                    </div>

                    <!-- <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Image</label>
                            <input type="file" class="form-control" name="productImg" required>
                        </div>
                    </div>
                        -->
                        <?php
                        //error message
                        if (isset($_SESSION['error'])) {
                            echo '<div class="alert alert-danger mt-2">' . $_SESSION['error'] . '</div>';
                            unset($_SESSION['error']);
                        }
                        //success message
                        if (isset($_SESSION['success'])) {
                            echo '<div class="alert alert-success mt-2">' . $_SESSION['success'] . '</div>';
                            unset($_SESSION['success']);
                        }
                        ?>


                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Add User</button>
                </div>
            </form>
        </div>
    </div>
</div>