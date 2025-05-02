<div class="modal fade" id="editAdminModal<?= $admin['admin_id']; ?>" tabindex="-1" aria-labelledby="editAdminModa<?= $admin['admin_id']; ?>Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <form action="/admin/admin?id=<?= $admin['admin_id']; ?>" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="_method" value="PATCH">
                <input type="hidden" name="id" value="<?= $admin['admin_id'] ?>">
                <!-- <input type="hidden" name="old_product_img" value="<?= $admin['product_img']; ?>"> -->
                <div class="modal-header border-0">
                    <h5 class="modal-title" id="editAdminModal<?= $i; ?>Label">Edit Admin Info</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row px-0">
                        <div class="row">
                        <div class="col-md-6">

                            <div class="mb-3">
                                <label class="form-label">Admin Name</label>
                                <input type="text" class="form-control" name="adminName" value="<?= htmlspecialchars($admin['admin_name']); ?>" required>
                            </div>
                           
                            <div class="mb-3">
                                <label class="form-label">email</label>
                                <textarea class="form-control" name="email" rows="4" required><?= htmlspecialchars($admin['email']); ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">username</label>
                                <textarea class="form-control" name="username" rows="4" required><?= htmlspecialchars($admin['username']); ?></textarea>
                            </div>
                        </div>
                        <!-- <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Image</label>
                                <input type="file" class="form-control" name="productImg">
                                <small>Current Image:</small>
                                <div>
                                    <img src="/images/products/<?= htmlspecialchars($admin['product_img']); ?>" alt="Product Image" class="img-thumbnail" style="max-width: 150px;">
                                </div>
                            </div>
                        </div> -->
                    </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success px-4">Edit</button>
                </div>
            </form>
        </div>
    </div>
</div>