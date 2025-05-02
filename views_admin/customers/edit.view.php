<div class="modal fade" id="editCustomerModal<?= $customer['customer_id']; ?>" tabindex="-1" aria-labelledby="editCustomerModal<?= $customer['customer_id']; ?>Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <form action="/admin/customer?id=<?= $customer['customer_id']; ?>" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="_method" value="PATCH">
                <input type="hidden" name="id" value="<?= $customer['customer_id'] ?>">
                <!-- <input type="hidden" name="old_product_img" value="<?= $customer['customer_img']; ?>"> -->
                <div class="modal-header border-0">
                    <h5 class="modal-title" id="editCustomerModal<?= $i; ?>Label">Edit Customer Info</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row px-0">
                        <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Customer Name</label>
                                <input value="<?= htmlspecialchars($customer['customer_name']); ?>" type="text" class="form-control" name="customerName" id="customerName" required >
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Customer Address</label>
                                <input value="<?= htmlspecialchars($customer['customer_address']); ?>" type="text" class="form-control" name="customerAddress" id="customerAddress " required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Phone No</label>
                                <input value="<?= htmlspecialchars($customer['customer_phone']); ?>" type="number" class="form-control" name="customerPhone" id="customerPhone" required>
                            </div>
                        </div>
                        <!-- <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Image</label>
                                <input type="file" class="form-control" name="productImg">
                                <small>Current Image:</small>
                                <div>
                                    <img src="/images/products/<?= htmlspecialchars($customer['customer_img']); ?>" alt="Product Image" class="img-thumbnail" style="max-width: 150px;">
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