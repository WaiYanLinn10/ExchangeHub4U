<div class="modal fade" id="deleteCategoryModal<?= $category['category_id']; ?>" tabindex="-1" aria-labelledby="deleteCategoryModal<?= $category['category_id']; ?>Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="/admin/category?id=<?= $category['category_id']; ?>" method="POST">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="category_id" value="<?= htmlspecialchars($category['category_id']); ?>">
                <div class="modal-header border-0">
                    <h3 class="modal-title text-danger mx-auto" id="deleteCategoryModal<?= $category['category_id']; ?>Label">Are you sure?</h3>
                </div>
                <div class="modal-body text-center">
                    <p>Do you really want to delete this category? This process <strong class="text-danger">cannot be undone</strong>.</p>
                </div>
                <div class="modal-footer justify-content-center border-0">
                    <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger px-4">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>


