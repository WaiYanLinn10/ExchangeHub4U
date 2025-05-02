<div class="modal fade" id="addAdminModal" tabindex="-1" aria-labelledby="addAdminModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <form action="/admin/admin" method="POST" enctype="multipart/form-data">
                <div class="modal-header border-0">
                    <h5 class="modal-title" id="addAdminModalLabel">Add Admin</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Admin Name</label>
                            <input type="text" class="form-control" name="adminName" id="adminName" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">User</label>
                            <select class="form-select" name="user_id" id="userSelect" required>
                                <option selected disabled>Select User</option>
                                <?php foreach ($users as $user) { 
                                    if ($user['user_type'] == 1) { ?>
                                        <option value="<?= $user['user_id']; ?>" data-username="<?= $user['username']; ?>">
                                            <?= $user['email']; ?>
                                        </option>
                                <?php } } ?>
                            </select>
                        </div>

                        <script>
                            document.getElementById("userSelect").addEventListener("change", function() {
                                var selectedOption = this.options[this.selectedIndex];
                                var username = selectedOption.getAttribute("data-username") || "";
                                var adminNameInput = document.getElementById("adminName");

                                // Auto-fill the Admin Name field but allow manual edits
                                adminNameInput.value = username;
                            });
                        </script>
                        
                        <?php
                        //error message
                        if (isset($_SESSION['error'])) {
                            echo '<div class="alert alert-danger mt-2">' . $_SESSION['error'] . '</div>';
                            unset($_SESSION['error']);
                        }
                        ?>

                        <!-- <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Image</label>
                                <input type="file" class="form-control" name="adminImg">
                                <small>Current Image:</small>
                                <div>
                                    <img src="/images/users/<?= htmlspecialchars($user['user_img']); ?>" alt="User Image" class="img-thumbnail" style="max-width: 150px;">
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Add Admin</button>
                </div>
            </form>
        </div>
    </div>
</div>