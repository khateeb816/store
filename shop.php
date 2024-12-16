<?php
include './includes/header.php';
include './db.php';
$sqlCategories = $conn->query("SELECT * FROM `categories`");
$categories = [];
while ($row = $sqlCategories->fetch_assoc()) {
    $categories[] = $row;
}

$sqlBrands = $conn->query("SELECT * FROM `brands`");
$brands = [];
while ($row = $sqlBrands->fetch_assoc()) {
    $brands[] = $row;
}

function displayItems($arr)
{
    foreach ($arr as $item) {


        $image = (array) json_decode($item['images']);
        echo "<div class='col-lg-4 col-md-6'>
                <div class='product__item'>
                    <div class='product__item__pic set-bg' data-setbg='dashbord/{$image[0]}'>
                        <ul class='product__hover'>
                            <li><a href='./dashbord/{$image[0]}' class='image-popup'><i class='fa-solid fa-expand'></i></a></li>
                            <li><a href='" . (isset($_SESSION['email']) ? "add_to_favourite.php?product={$item['id']}&user={$_SESSION['id']}" : 'login.php') . "' ><i class='fa-regular fa-heart'></i></a></li>
                            <li><a href='./product-details.php?id={$item['id']}'><i class='fa-solid fa-maximize'></i></a></li>
                        </ul>
                    </div>
                    <div class='product__item__text'>
                        <h6><a href='#'>{$item['name']}</a></h6>
                        <div class='rating'>
                            <i class='fa fa-star'></i>
                            <i class='fa fa-star'></i>
                            <i class='fa fa-star'></i>
                            <i class='fa fa-star'></i>
                            <i class='fa fa-star'></i>
                        </div>
                        <div class='product__price'>$ {$item['discounted_price']}.0</div>
                    </div>
                </div>
             </div> ";
    }
}
?>

<section class="shop spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3">
                <div class="shop__sidebar">
                    <div class="sidebar__categories">
                        <div class="section-title">
                            <h4>Categories</h4>
                        </div>
                        <div class="categories__accordion">
                            <div class="accordion" id="accordionExample">
                                <?php
                                foreach ($categories as $category) {
                                    echo "<p onclick = 'formatByCategory({$category['id']})' style = 'cursor : pointer;'> {$category['name']} </p>";
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="sidebar__filter">
                        <div class="section-title">
                            <h4>Shop by price</h4>
                        </div>
                        <div class="filter-range-wrap">
                            <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
                                data-min="10" data-max="999" id="priceRange"></div>
                            <div class="range-slider">
                                <div class="price-input">
                                    <p>Price:</p>
                                    <input type="text" id="minamount">
                                    <input type="text" id="maxamount">
                                </div>
                            </div>
                        </div>
                        <a href="#" onclick="formatByRange()">Filter</a>
                    </div>
                    <div class="sidebar__sizes">
                        <div class="section-title">
                            <h4>Shop by size</h4>
                        </div>
                        <div class="size__list">
                            <label for="xs">
                                xs
                                <input type="radio" <?php if (isset($_GET['size'])) {
                                                        echo $_GET['size'] == 'xs' ? 'checked' : '';
                                                    } ?> id="xs" name="size" onchange="formatBySize('xs')">
                                <span class="checkmark"></span>
                            </label>
                            <label for="s">
                                s
                                <input type="radio" <?php if (isset($_GET['size'])) {
                                                        echo $_GET['size'] == 's' ? 'checked' : '';
                                                    } ?> id="s" name="size" onchange="formatBySize('s')">
                                <span class="checkmark"></span>
                            </label>
                            <label for="m">
                                m
                                <input type="radio" <?php if (isset($_GET['size'])) {
                                                        echo $_GET['size'] == 'm' ? 'checked' : '';
                                                    } ?> id="m" name="size" onchange="formatBySize('m')">
                                <span class="checkmark"></span>
                            </label>
                            <label for="l">
                                l
                                <input type="radio" <?php if (isset($_GET['size'])) {
                                                        echo $_GET['size'] == 'l' ? 'checked' : '';
                                                    } ?> id="l" name="size" onchange="formatBySize('l')">
                                <span class="checkmark"></span>
                            </label>
                            <label for="xl">
                                xl
                                <input type="radio" <?php if (isset($_GET['size'])) {
                                                        echo $_GET['size'] == 'xl' ? 'checked' : '';
                                                    } ?> id="xl" name="size" onchange="formatBySize('xl')">
                                <span class="checkmark"></span>
                            </label>
                            <label for="xxl">
                                xxl
                                <input type="radio" <?php if (isset($_GET['size'])) {
                                                        echo $_GET['size'] == 'xxl' ? 'checked' : '';
                                                    } ?> id="xxl" name="size" onchange="formatBySize('xxl')">
                                <span class="checkmark"></span>
                            </label>
                        </div>

                    </div>
                    <div class="sidebar__color">
                        <div class="section-title">
                            <h4>Shop by Brands</h4>
                        </div>
                        <div class="size__list color__list">
                            <?php
                            foreach ($brands as $brand) {
                                echo "<p onclick = 'formatByBrand({$brand['id']})' style = 'cursor : pointer;'> {$brand['name']} </p>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-9">
                <div class="row">
                    <?php
                    $products = [];
                    if (isset($_GET['category'])) {
                        $sql = $conn->query("SELECT * FROM `products` WHERE `category_id` = '{$_GET['category']}'");
                        while ($row = $sql->fetch_assoc()) {
                            $products[] = $row;
                        }
                    } elseif (isset($_GET['brand'])) {
                        $sql = $conn->query("SELECT * FROM `products` WHERE `brand_id` = '{$_GET['brand']}'");
                        while ($row = $sql->fetch_assoc()) {
                            $products[] = $row;
                        }
                    } elseif (isset($_GET['size'])) {
                        $givenSize = strtoupper($_GET['size']);
                        $sql = $conn->query("SELECT * FROM `products`");
                        while ($row = $sql->fetch_assoc()) {
                            $size = (array) json_decode($row['sizes']);
                            if ($size[$givenSize] == TRUE) {
                                $products[] = $row;
                            }
                        }
                    } elseif (isset($_GET['min']) && isset($_GET['max'])) {
                        $min = (int)$_GET['min'];
                        $max = (int)$_GET['max'];

                        $sql = $conn->query("SELECT * FROM `products` WHERE `discounted_price` BETWEEN $min AND $max ORDER BY `discounted_price` ASC");
                        while ($row = $sql->fetch_assoc()) {
                            $products[] = $row;
                        }
                    } else {
                        $sql = $conn->query("SELECT * FROM `products`");
                        while ($row = $sql->fetch_assoc()) {
                            $products[] = $row;
                        }
                    }

                    displayItems($products);
                    ?>

                </div>
            </div>
        </div>
    </div>
</section>
<!-- Shop Section End -->
<script>
    function formatByCategory(id) {
        window.location.href = "shop.php?category=" + id;
    }

    function formatByBrand(id) {
        window.location.href = "shop.php?brand=" + id;
    }

    function formatBySize(size) {
        window.location.href = "shop.php?size=" + size;
    }

    function formatByRange() {
        let minAmount = document.getElementById('minamount').value;
        minAmount = Number(minAmount.slice(1));
        let maxAmount = document.getElementById('maxamount').value;
        maxAmount = Number(maxAmount.slice(1));
        window.location.href = "shop.php?min=" + minAmount + "&max=" + maxAmount;
    }
</script>

<?php
include './includes/footer.php';
?>