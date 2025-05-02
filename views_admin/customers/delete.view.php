<div class="modal fade" id="deleteCustomerModal<?= $customer['customer_id']; ?>" tabindex="-1" aria-labelledby="deleteCustomerModal<?= $customer['customer_id']; ?>Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="/admin/customer?id=<?= $customer['customer_id']; ?>" method="POST">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="customer_id" value="<?= htmlspecialchars($customer['customer_id']); ?>">
                <div class="modal-header border-0">
                    <h3 class="modal-title text-danger mx-auto" id="deleteCustomerModal<?= $customer['customer_id']; ?>Label">Are you sure?</h3>
                </div>
                <div class="modal-body text-center">
                    <p>Do you really want to delete this customer? This process <strong class="text-danger">cannot be undone</strong>.</p>
                </div>
                <div class="modal-footer justify-content-center border-0">
                    <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger px-4">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>
