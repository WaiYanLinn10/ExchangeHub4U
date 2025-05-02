<div class="modal fade" id="editCategoryModal<?php echo $category['category_id'];?>" tabindex="-1" aria-labelledby="editCategoryModal<?php echo $category['category_id'];?>Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="/admin/category?id=<?php echo $category['category_id'];?>" method="POST"  enctype="multipart/form-data">
            <input type="hidden" name="_method" value="PATCH">
            <input type="hidden" name="id" value="<?php echo $category['category_id'];?>">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="editCategoryModal<?php echo $category['category_id'];?>Label">Edit Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row px-0">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="categoryName" class="form-label">Category Name</label>
                                <input type="text" class="form-control" name="categoryName" value="<?php echo $category['category_name'];?>" aria-describedby="categoryNameHelp">
                                <div id="categoryNameHelp" class="form-text">Do not exceed 30 characters when entering the category name.</div>
                            </div>
                            <div class="mb-3">
                                <label for="categoryDescription" class="form-label">Category Description</label>
                                <textarea class="form-control" name="categoryDescription" rows="3"><?php echo $category['category_description'];?></textarea>
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

