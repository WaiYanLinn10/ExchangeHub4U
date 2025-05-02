<div class="modal fade" id="editProductModal<?= $product['product_id']; ?>" tabindex="-1" aria-labelledby="editProductModal<?= $product['product_id']; ?>Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <form action="/admin/product?id=<?= $product['product_id']; ?>" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="_method" value="PATCH">
                <input type="hidden" name="id" value="<?= $product['product_id'] ?>">
                <input type="hidden" name="old_product_img" value="<?= $product['product_img']; ?>">
                <div class="modal-header border-0">
                    <h5 class="modal-title" id="editProductModal<?= $product['product_id']; ?>Label">Edit Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row px-0">
                        <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Product Name</label>
                                <input type="text" class="form-control" name="productName" value="<?= htmlspecialchars($product['product_name']); ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Category</label>
                                <select class="form-select" name="category" required>
                                    <option disabled>Select Category</option>
                                    <?php foreach ($categories as $category) { ?>
                                        <option value="<?= $category['category_id']; ?>" <?= $category['category_id'] == $product['category_id'] ? 'selected' : ''; ?>>
                                            <?= htmlspecialchars($category['category_name']); ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Brand</label>
                                <select class="form-select" name="brand" required>
                                    <option disabled>Select Brand</option>
                                    <?php foreach ($brands as $brand) { ?>
                                        <option value="<?= $brand['brand_id']; ?>" <?= $brand['brand_id'] == $product['brand_id'] ? 'selected' : ''; ?>>
                                            <?= htmlspecialchars($brand['brand_name']); ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea class="form-control" name="productDescription" rows="4" required><?= htmlspecialchars($product['product_description']); ?></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Price</label>
                                <input type="number" class="form-control" name="productPrice" value="<?= htmlspecialchars($product['product_price']); ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Quantity</label>
                                <input type="number" class="form-control" name="productQuantity" value="<?= htmlspecialchars($product['product_quantity']); ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Image</label>
                                <input type="file" class="form-control" name="productImg">
                                <small>Current Image:</small>
                                <div>
                                    <img src="/images/products/<?= htmlspecialchars($product['product_img']); ?>" alt="Product Image" class="img-thumbnail" style="max-width: 150px;">
                                </div>
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