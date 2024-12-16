<?php

include './includes/header.php';
include './db.php';
$sqlCategories = "SELECT * FROM categories WHERE status_of = 'Allow' LIMIT 5";
$sqlCategories_result = $conn->query($sqlCategories);

$categories = [];

while ($rowCategories = $sqlCategories_result->fetch_array()) {
    $categories[] = $rowCategories;
}

$sqlProducts = "SELECT * FROM products WHERE `show` = 'New' ORDER BY added_at LIMIT 8";
$sqlProducts_result = $conn->query($sqlProducts);

$products = [];

while ($rowProducts = $sqlProducts_result->fetch_array()) {
    $products[] = $rowProducts;
}
?>
<!-- Categories Section Begin -->

<section class="categories">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 p-0">
                <div class="categories__item categories__large__item set-bg"
                    data-setbg="<?php echo "./dashbord/" . $categories[0]['image_path'] ?>">
                    <div class="categories__text">
                        <h1><?php echo $categories[0]['name'] ?></h1>
                        <p><?php echo $categories[0]['description'] ?></p>
                        <a href="./shop.php?category=<?php echo $categories[0]['id'];?>">Shop now</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                        <div class="categories__item set-bg" data-setbg="<?php echo "./dashbord/" . $categories[1]['image_path'] ?>">
                            <div class="categories__text">
                                <h4><?php echo $categories[1]['name'] ?></h4>
                                <p>358 items</p>
                                <a href="./shop.php?category=<?php echo $categories[1]['id'];?>">Shop now</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                        <div class="categories__item set-bg" data-setbg="<?php echo "./dashbord/" . $categories[2]['image_path'] ?>">
                            <div class="categories__text">
                                <h4><?php echo $categories[2]['name'] ?></h4>
                                <p>273 items</p>
                                <a href="./shop.php?category=<?php echo $categories[2]['id'];?>">Shop now</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                        <div class="categories__item set-bg" data-setbg="<?php echo "./dashbord/" . $categories[3]['image_path'] ?>">
                            <div class="categories__text">
                                <h4><?php echo $categories[3]['name'] ?></h4>
                                <p>159 items</p>
                                <a href="./shop.php?category=<?php echo $categories[3]['id'];?>">Shop now</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                        <div class="categories__item set-bg" data-setbg="<?php echo "./dashbord/" . $categories[4]['image_path'] ?>">
                            <div class="categories__text">
                                <h4><?php echo $categories[4]['name'] ?></h4>
                                <p>792 items</p>
                                <a href="./shop.php?category=<?php echo $categories[4]['id'];?>">Shop now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Categories Section End -->

<!-- Product Section Begin -->
<section class="product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4">
                <div class="section-title">
                    <h4>New product</h4>
                </div>
            </div>
        </div>
        <div class="row property__gallery">
            <?php
            foreach ($products as $product) {
                $img = json_decode($product['images']);
                $img = (array) $img;

                echo "
                <div class='col-lg-3 col-md-4 col-sm-6 mix women'>
                    <div class='product__item'>
                        <div class='product__item__pic set-bg' data-setbg='./dashbord/{$img[0]}'>
                            <div class='label new'>New</div>
                            <ul class='product__hover'>
                                <li>
                                    <a href='./dashbord/{$img[0]}' class='image-popup'>
                                        <i class='fa-solid fa-expand'></i>
                                    </a>
                                </li>
                                <li>
                                    <a href='" . (isset($_SESSION['email'])
                    ? "add_to_favourite.php?product={$product['id']}&user={$_SESSION['id']}"
                    : 'login.php') . "'>
                                        <i class='fa-regular fa-heart'></i>
                                    </a>
                                </li>
                                <li>
                                    <a href='./product-details.php?id={$product['id']}'>
                                        <i class='fa-solid fa-maximize'></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class='product__item__text'>
                            <h6><a href='#'>{$product['name']}</a></h6>
                            <div class='rating'>
                                <i class='fa fa-star'></i>
                                <i class='fa fa-star'></i>
                                <i class='fa fa-star'></i>
                                <i class='fa fa-star'></i>
                                <i class='fa fa-star'></i>
                            </div>
                            <div class='product__price'>$ {$product['discounted_price']}.0</div>
                        </div>
                    </div>
                </div>
                ";
            }
            ?>
        </div>
    </div>
</section>
<!-- Product Section End -->

<!-- Banner Section Begin -->
<section class="banner set-bg" data-setbg="img/banner/banner-1.jpg">
    <div class="container">
        <div class="row">
            <div class="col-xl-7 col-lg-8 m-auto">
                <div class="banner__slider owl-carousel">
                    <?php
                    $sqlBrand = "SELECT * FROM `brands` WHERE `status` = 'Allow'";
                    $sqlBrandResult = $conn->query($sqlBrand);
                    $brands = [];
                    while ($row = $sqlBrandResult->fetch_assoc()) {
                        $brands[] = $row;
                    }
                    foreach ($brands as $brand) {
                        echo "
                        <div class='banner__item'>
                        <div class='banner__text'>
                            <span>{$brand['name']}</span>
                            <h1>{$brand['description']}</h1>
                            <a href='#'>Shop now</a>
                        </div>
                    </div>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Banner Section End -->

<!-- Trend Section Begin -->
<section class="trend spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="trend__content">
                    <div class="section-title">
                        <h4>Hot Trend</h4>
                    </div>

                    <?php
                    $sqlHot = "SELECT * FROM `products` WHERE `status` = 'Allow' && `show` = 'Hot' LIMIT 3";
                    $sqlHotResult = $conn->query($sqlHot);
                    $hotProducts = [];
                    while ($row = $sqlHotResult->fetch_assoc()) {
                        $hotProducts[] = $row;
                    }

                    foreach ($hotProducts as $hotProduct) {
                        $image =  json_decode($hotProduct['images']);
                        $image = (array) $image;
                        echo "<div class='trend__item'>
                        <div class='trend__item__pic'>
                            <a href='./product-details.php?id={$hotProduct['id']}''><img src='./dashbord/{$image['0']}' style ='width:100px; height: 100px;'></a>
                        </div>
                        <div class='trend__item__text'>
                            <h6>{$hotProduct['name']}</h6>
                            <div class='rating'>
                                <i class='fa fa-star'></i>
                                <i class='fa fa-star'></i>
                                <i class='fa fa-star'></i>
                                <i class='fa fa-star'></i>
                                <i class='fa fa-star'></i>
                            </div>
                            <div class='product__price'>$ {$hotProduct['discounted_price']}</div>
                        </div>
                    </div>";
                    }
                    ?>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="trend__content">
                    <div class="section-title">
                        <h4>Best seller</h4>
                    </div>

                    <?php
                    $sqlBest = "SELECT * FROM `products` WHERE `status` = 'Allow' && `show` = 'Best' LIMIT 3";
                    $sqlBestResult = $conn->query($sqlBest);
                    $hotProducts = [];
                    while ($row = $sqlBestResult->fetch_assoc()) {
                        $hotProducts[] = $row;
                    }

                    foreach ($hotProducts as $hotProduct) {
                        $image =  json_decode($hotProduct['images']);
                        $image = (array) $image;
                        echo "<div class='trend__item'>
                        <div class='trend__item__pic'>
                             <a href='./product-details.php?id={$hotProduct['id']}''><img src='./dashbord/{$image['0']}' style ='width:100px; height: 100px;'></a>
                        </div>
                        <div class='trend__item__text'>
                            <h6>{$hotProduct['name']}</h6>
                            <div class='rating'>
                                <i class='fa fa-star'></i>
                                <i class='fa fa-star'></i>
                                <i class='fa fa-star'></i>
                                <i class='fa fa-star'></i>
                                <i class='fa fa-star'></i>
                            </div>
                            <div class='product__price'>$ {$hotProduct['discounted_price']}</div>
                        </div>
                    </div>";
                    }
                    ?>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="trend__content">
                    <div class="section-title">
                        <h4>Feature</h4>
                    </div>

                    <?php
                    $sqlFeatured = "SELECT * FROM `products` WHERE `status` = 'Allow' && `show` = 'Featured' LIMIT 3";
                    $sqlFeaturedResult = $conn->query($sqlFeatured);
                    $hotProducts = [];
                    while ($row = $sqlFeaturedResult->fetch_assoc()) {
                        $featuredProducts[] = $row;
                    }

                    foreach ($featuredProducts as $featuredProduct) {
                        $image =  json_decode($featuredProduct['images']);
                        $image = (array) $image;
                        echo "<div class='trend__item'>
                        <div class='trend__item__pic'>
                             <a href='./product-details.php?id={$featuredProduct['id']}''><img src='./dashbord/{$image['0']}' style ='width:100px; height: 100px;'></a>
                        </div>
                        <div class='trend__item__text'>
                            <h6>{$featuredProduct['name']}</h6>
                            <div class='rating'>
                                <i class='fa fa-star'></i>
                                <i class='fa fa-star'></i>
                                <i class='fa fa-star'></i>
                                <i class='fa fa-star'></i>
                                <i class='fa fa-star'></i>
                            </div>
                            <div class='product__price'>$ {$featuredProduct['discounted_price']}</div>
                        </div>
                    </div>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Trend Section End -->

<!-- Services Section Begin -->
<section class="services spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="services__item">
                    <i class="fa fa-car"></i>
                    <h6>Free Shipping</h6>
                    <p>For all oder over $99</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="services__item">
                    <i class="fa fa-money"></i>
                    <h6>Money Back Guarantee</h6>
                    <p>If good have Problems</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="services__item">
                    <i class="fa fa-support"></i>
                    <h6>Online Support 24/7</h6>
                    <p>Dedicated support</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="services__item">
                    <i class="fa fa-headphones"></i>
                    <h6>Payment Secure</h6>
                    <p>100% secure payment</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Services Section End -->

<?php include './includes/footer.php' ?>