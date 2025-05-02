<div class="modal fade" id="deleteBrandModal<?= $brand['brand_id']; ?>" tabindex="-1" aria-labelledby="deleteBrandModal<?= $brand['brand_id']; ?>Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="/admin/brand?id=<?= $brand['brand_id']; ?>" method="POST">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="brand_id" value="<?= htmlspecialchars($brand['brand_id']); ?>">
                <div class="modal-header border-0">
                    <h3 class="modal-title text-danger mx-auto" id="deleteBrandModal<?= $brand['brand_id']; ?>Label">Are you sure?</h3>
                </div>
                <div class="modal-body text-center">
                    <p>Do you really want to delete this brand? This process <strong class="text-danger">cannot be undone</strong>.</p>
                </div>
                <div class="modal-footer justify-content-center border-0">
                    <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger px-4">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>


