<div class="modal fade" id="editUserModal<?= $user['user_id']; ?>" tabindex="-1" aria-labelledby="editUserModal<?= $user['user_id']; ?>Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <form action="/admin/user?id=<?= $user['user_id']; ?>" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="_method" value="PATCH">
                <input type="hidden" name="id" value="<?= $user['user_id'] ?>">

                <div class="modal-header border-0">
                    <h5 class="modal-title" id="editUserModal<?= $i; ?>Label">Edit user Info</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row px-0">
                        <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">username</label>
                                <input value="<?= htmlspecialchars($user['username']); ?>" type="text" class="form-control" name="userName" id="userName" required >
                            </div>
                            <div class="mb-3">
                                <label class="form-label">email</label>
                                <input value="<?= htmlspecialchars($user['email']); ?>" type="text" class="form-control" name="userEmail" id="userEmail " required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input value="" type="password" class="form-control" placeholder="Leave Black if no need to change password" name="password" id="password ">
                            </div>
                        </div>
                       
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