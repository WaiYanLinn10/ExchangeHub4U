<div class="modal fade" id="addCustomerModal" tabindex="-1" aria-labelledby="addCustomerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <form action="/admin/customer" method="POST" enctype="multipart/form-data">
                <div class="modal-header border-0">
                    <h5 class="modal-title" id="addCustomerModalLabel">Add Customer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Customer Name</label>
                            <input type="text" class="form-control" name="customerName" id="customerName" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Customer Address</label>
                            <input type="text" class="form-control" name="customerAddress" id="customerAddress" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Phone No</label>
                            <input type="number" class="form-control" name="customerPhone" id="customerPhone" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">User</label>
                            <select class="form-select" name="user_id" id="userSelect" required>
                                <option selected disabled>Select User</option>
                                <?php foreach ($users as $user) { 
                                    if ($user['user_id'] && !in_array($user['user_id'], array_column($customers, 'user_id'))) { ?>
                                        <option value="<?= $user['user_id']; ?>" data-username="<?= $customer['username']; ?>">
                                            <?= $user['email']; ?>
                                        </option>
                                <?php } } ?>
                            </select>
                            
                        </div>

                        <script>
                            document.getElementById("userSelect").addEventListener("change", function() {
                                var selectedOption = this.options[this.selectedIndex];
                                var username = selectedOption.getAttribute("data-username") || "";

                                // Set the username field with the selected user's name
                                document.getElementById("username").value = username;
                            });
                        </script>

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
                    <button type="submit" class="btn btn-success">Add Customer</button>
                </div>
            </form>
        </div>
    </div>
</div>