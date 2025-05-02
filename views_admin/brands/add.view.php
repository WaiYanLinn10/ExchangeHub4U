
<div class="modal fade" id="addBrandModal" tabindex="-1" aria-labelledby="addBrandModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered ">
        <div class="modal-content">
            <form action="/admin/brand" method="POST" enctype="multipart/form-data">
            <div class="modal-header border-0">
                <h5 class="modal-title text-center" id="addBrandModalLabel">Add Brand</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row px-0">
                        <div class="col-12">
                            <div class="mb-3">
                            <label for="brandName" class="form-label">Brand Name</label>
                                <input type="text" class="form-control" name="brandName" aria-describedby="brandNameHelp">
                                <div id="brandNameHelp" class="form-text">Do not exceed 30 characters when entering the brand name.</div>
                            </div>
                            <div class="mb-3">
                                <label for="brandImg" class="form-label">Brand Image</label>
                                <input type="file" class="form-control" name="brandImg" required>
                            </div>
                        </div>   
                    </div>
                </div>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success px-4">Create</button>
            </div>
            </form>
        </div>
    </div>
</div>
