
<div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered ">
        <div class="modal-content">
            <form action="/admin/category" method="POST" enctype="multipart/form-data">
            <div class="modal-header border-0">
                <h5 class="modal-title text-center" id="addCategoryModalLabel">Add Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row px-0">
                        <div class="col-12">
                            <div class="mb-3">
                            <label for="categoryName" class="form-label">Category Name</label>
                                <input type="text" class="form-control" name="categoryName" aria-describedby="categoryNameHelp">
                                <div id="categoryNameHelp" class="form-text">Do not exceed 30 characters when entering the category name.</div>
                            </div>
                            <div class="mb-3">
                                <label for="categoryDescription" class="form-label">Category Description</label>
                                <textarea class="form-control" name="categoryDescription" rows="3"></textarea>
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
