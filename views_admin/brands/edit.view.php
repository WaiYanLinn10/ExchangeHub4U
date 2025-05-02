<div class="modal fade" id="editBrandModal<?php echo $brand['brand_id'];?>" tabindex="-1" aria-labelledby="editBrandModal<?php echo $brand['brand_id'];?>Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="/admin/brand?id=<?php echo $brand['brand_id'];?>" method="POST"  enctype="multipart/form-data">
            <input type="hidden" name="_method" value="PATCH">
            <input type="hidden" name="id" value="<?php echo $brand['brand_id'];?>">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="editBrandModal<?php echo $brand['brand_id'];?>Label">Edit Brand</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row px-0">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="brandName" class="form-label">Brand Name</label>
                                <input type="text" class="form-control" name="brandName" value="<?php echo $brand['brand_name'];?>" aria-describedby="brandNameHelp">
                                <div id="brandNameHelp" class="form-text">Do not exceed 30 characters when entering the product name.</div>
                            </div>
                            <div class="mb-3">
                                <label for="brandImg" class="form-label">Brand Image</label>
                                <img src="../images/brands/<?php echo $brand['brand_img'];?>" alt="" class="img-fluid d-block" style="height: 300px;">
                                <input type="file" class="form-control" name="brandImg">
                            </div>
                            <img class="img-fluid" id="brandImgPreview">
                            <div class="mb-3">
                                <input type="hidden" name="old_brand_img" value="<?php echo $brand['brand_img'];?>">
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

