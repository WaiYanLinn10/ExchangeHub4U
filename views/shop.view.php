<?php require('partials/head.php') ?>
<?php require('partials/nav.php') ?>
<?php require('partials/banner.php') ?>


<main>
    <div class="container my-5">
        <div class="row">
            <div class="col-md-3">
                <!-- Categories -->
                <h5 class="pb-2 border-bottom border-2 fw-bold">Categories</h5>
                <ul class="list-group mb-5">
                    <li class="list-group-item px-0 border-0 border-bottom rounded-0">
                        <a href="/shop" class="text-decoration-none text-dark">
                            All
                            <!-- <span class="badge p-1 rounded-pill"><?= $categoryAllCount ?></span> -->
                        </a>
                    </li>
                    <?php foreach ($categories as $category): ?>
                        <?php
                        // Get product count for each category
                        $categoryCountSql = "SELECT * FROM product WHERE category_id = " . $category['category_id'];
                        $categoryCountResult = $db->query($categoryCountSql)->get();
                        $categoryCount = count($categoryCountResult);
                        ?>
                        <li class="list-group-item px-0 border-0 border-bottom rounded-0">
                            <a href="/shop?category=<?= $category['category_id'] ?>" class="text-decoration-none <?= isset($filters['category']) && $filters['category'] == $category['category_id'] ? 'link-secondary fw-bold' : 'link-dark' ?>">
                                <?= $category['category_name'] ?>
                                <span class="badge p-1 secondary-btn rounded-pill"><?= $categoryCount ?></span>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>

                <!-- Price Range -->
                <h5 class="pb-2 border-bottom border-2 fw-bold">Price</h5>
                <ul class="list-group mb-5">
                    <li class="list-group-item px-0 border-0 border-bottom rounded-0">
                        <a href="/shop" class="text-decoration-none <?= isset($filters['start']) && isset($filters['end']) ? 'link-dark' : 'link-secondary fw-bold' ?>">All</a>
                    </li>
                    <li class="list-group-item px-0 border-0 border-bottom rounded-0">
                        <a href="/shop?start=0&end=50000" class="text-decoration-none <?= isset($filters['start']) && $filters['start'] == 0 && $filters['end'] == 50000 ? 'link-secondary fw-bold' : 'link-dark' ?>">0 - 50000</a>
                    </li>
                    <li class="list-group-item px-0 border-0 border-bottom rounded-0">
                        <a href="/shop?start=50001&end=100000" class="text-decoration-none <?= isset($filters['start']) && $filters['start'] == 50001 && $filters['end'] == 100000 ? 'link-secondary fw-bold' : 'link-dark' ?>">50001 - 100000</a>
                    </li>
                    <li class="list-group-item px-0 border-0 border-bottom rounded-0">
                        <a href="/shop?start=1000001&end=1500000" class="text-decoration-none <?= isset($filters['start']) && $filters['start'] == 1000001 && $filters['end'] == 1500000 ? 'link-secondary fw-bold' : 'link-dark' ?>">1000001 - 1500000</a>
                    </li>
                    <li class="list-group-item px-0 border-0 border-bottom rounded-0">
                        <a href="/shop?start=1500001&end=2000000" class="text-decoration-none <?= isset($filters['start']) && $filters['start'] == 1500001 && $filters['end'] == 2000000 ? 'link-secondary fw-bold' : 'link-dark' ?>">1500001 - 2000000</a>
                    </li>
                    <li class="list-group-item px-0 border-0 border-bottom rounded-0">
                        <a href="/shop?start=2000001&end=9999999" class="text-decoration-none <?= isset($filters['start']) && $filters['start'] == 2000001 && $filters['end'] == 9999999 ? 'link-secondary fw-bold' : 'link-dark' ?>">2000001 - 9999999</a>
                    </li>
                    <li class="list-group-item px-0 border-0 border-bottom rounded-0">
                        <a href="/shop?start=10000000&end=999999999" class="text-decoration-none <?= isset($filters['start']) && $filters['start'] == 10000000 && $filters['end'] == 999999999 ? 'link-secondary fw-bold' : 'link-dark' ?>">>10000000</a>
                    </li>
                </ul>
            </div>

            <div class="col-md-9">
                <div class="row">
                    <div class="col-sm-8">
                        <p class="text-muted mt-2">We found <strong><?= count($products) ?></strong> products available for you.</p>
                    </div>
                    <div class="col-sm-4">
                        <form action="/shop" method="GET">  
                            <div class="input-group">
                                <input type="text" name="search" class="form-control border-bottom border-0 text-dark rounded-0" placeholder="Search . . . " value="<?= isset($filters['search']) ? $filters['search'] : '' ?>">
                                <button class="btn btn-outline-secondary border-dark fw-bold rounded" type="submit">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="row mt-4">
                    <?php foreach ($products as $product): ?>
                        <div class="col-md-4 mb-5">
                            <div class="overflow-hidden text-center border" style="height:300px;">
                                <a href="/product?id=<?= $product['product_id'] ?>">
                                <img src="images/products/<?= $product['product_img'] ?>" alt="" class="img-fluid hvr-grow h-100">                            </div>
                                
                                <h6 class="mt-3 text-center" style="color:#7FBACD;"><?= $product['product_price'] ?> MMK</h6>
                            <h5 class="mt-2 text-center fw-bold"><a href="/product?id=<?= $product['product_id'] ?>" class="text-decoration-none link-dark"><?= $product['product_name'] ?></a></h5>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Pagination -->
                <nav class="d-flex justify-content-center">
                    <ul class="pagination">
                        <?php for ($i = 1; $i <= $numberOfPage; $i++): ?>
                            <li class="page-item <?= ($i == $currentPage) ? 'active' : '' ?>">
                                <a class="page-link custom-pagination-btn <?= ($i == $currentPage) ? 'custom-pagination-active' : '' ?>" 
                                href="/shop?page=<?= $i ?><?= isset($filters['category']) ? '&category=' . $filters['category'] : '' ?><?= isset($filters['start']) && isset($filters['end']) ? '&start=' . $filters['start'] . '&end=' . $filters['end'] : '' ?><?= isset($filters['search']) ? '&search=' . urlencode($filters['search']) : '' ?>">
                                    <?= $i ?>
                                </a>
                            </li>
                        <?php endfor; ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</main>



<?php require('partials/footer.php') ?>
