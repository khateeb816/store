<?php include 'includes/header.php';
include 'db.php';
$sqlGet = "SELECT * FROM products WHERE id = {$_GET['id']}";
$sqlGet_Result = $conn->query($sqlGet);
$row = $sqlGet_Result->fetch_assoc();
// print_r($row);
$shortDescription = $row['description'];
$shortDescription = substr($shortDescription, 0, 100);
$availableColors = json_decode($row['colors']);
$availableColors = (array) $availableColors;
$availableSizes = json_decode($row['sizes']);
$availableSizes = (array) $availableSizes;
$promotion = json_decode($row['promotion']);
$promotion = (array) $promotion;
$images = json_decode($row['images']);
$images = (array) $images;
?>

<!-- Product Details Section Begin -->
<section class="product-details spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="product__details__pic">
                    <div class="product__details__pic__left product__thumb nice-scroll">
                        <?php
                        $count = 1;
                        foreach ($images as $image) {
                            echo "<a class='pt active' href='#product-$count'>
                            <img src='./dashbord/$image'>
                        </a>";
                            $count++;
                        }
                        ?>

                    </div>
                    <div class="product__details__slider__content">
                        <div class="product__details__pic__slider owl-carousel">
                            <?php
                            $count = 1;
                            foreach ($images as $image) {
                                echo "<img data-hash='product-$count' class='product__big__img' src='./dashbord/$image'>";
                                $count++;
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="product__details__text">
                    <h3><?php echo $row['name']; ?></span></h3>
                    <div class="product__details__price">$<?php echo $row['discounted_price']; ?>.0<span>$<?php echo $row['orignal_price']; ?>.0</span></div>
                    <p><?php echo $shortDescription; ?></p>
                    <form action="add_to_cart.php" method="post" class="product__details__button">
                        <div class="quantity">
                            <span>Quantity:</span>
                            <div class="pro-qty">
                                <input type="number" value="1" name="quantity">
                                <input type="hidden" value="<?php echo $_GET['id'] ?>" name="Product_id">
                            </div>
                        </div>
                        <button type="button" data-toggle="modal" data-target="#exampleModal" type="submit" class="cart-btn" style="border: none;"><i class='fa-solid fa-cart-shopping'></i> Add to cart</button>


                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Select Size and color</h5>

                                    </div>
                                    <div class="modal-body">
                                        <h3 class="mx-3 my-2" style="color: gray;">Select Colors:</h3>
                                        <div class="d-flex flex-row align-items-center my-2 mx-2">
                                            <select name="colors" id="colors">
                                                <?php
                                                foreach ($availableColors as $color => $value) {
                                                    if ($value) {
                                                        $displayColor = substr($color, 5, 11);
                                                        echo "<option class=' mx-2' style='border: 1px solid black;' id='quantity' placeholder='Quantity' name='$color' value='$displayColor'> <label for='Black'>$displayColor</label>";
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <h3 class="mx-3 my-2" style="color: gray;">Select Size:</h3>
                                        <div class="d-flex flex-row align-items-center my-2 mx-2">
                                        <select name="sizes" id="sizes">
                                                <?php
                                                foreach ($availableSizes as $size => $value) {
                                                    if ($value) {
                                                        echo "<option class=' mx-2' style='border: 1px solid black;' id='quantity' placeholder='Quantity' name='$size' value='$size'> <label for='Black'>$size</label>";
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-danger">Add to Cart</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="product__details__widget">
                        <ul>
                            <li>
                                <span>Availability:</span>
                                <div>
                                    <label for="stockin">
                                        <?php echo ($row['quantity'] > 0) ? ("In Stock") : ("Out of Stock"); ?>
                                    </label>
                                </div>
                            </li>
                            <li>
                                <span>Available color:</span>
                                <div class="color__checkbox">
                                    <?php
                                    foreach ($availableColors as $color => $value) {
                                        if ($value == TRUE) {
                                            $color = substr($color, 5);
                                            echo "<label for='{$color}'>
                                                <span style = 'background-color: $color !important; width : 20px; height: 20px; border-radius: 50%;'></span>
                                            </label>";
                                        }
                                    }
                                    ?>
                                </div>
                            </li>
                            <li>
                                <span>Available size:</span>
                                <div class="size__btn">
                                    <?php
                                    foreach ($availableSizes as $size => $value) {
                                        if ($value == TRUE) {
                                            echo "<label for='xs-btn' class='active'>
                                        <input type='radio' id='xs-btn'>
                                        $size
                                    </label>";
                                        }
                                    }
                                    ?>


                                </div>
                            </li>
                            <li>
                                <span>Promotions:</span>
                                <p><?php echo $promotion['promotionPercentage'] != "" ? ($promotion['promotionName'] . " " . $promotion['promotionPercentage']) : "No Promotion Available for now" ?>%</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="product__details__tab">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">Description</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">Specification</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tabs-1" role="tabpanel">
                            <h6>Description</h6>
                            <p><?php echo $row['description'] ?></p>
                        </div>
                        <div class="tab-pane" id="tabs-2" role="tabpanel">
                            <h6>Specification</h6>
                            <p><?php echo $row['specification'] ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Product Details Section End -->

<?php include 'includes/footer.php'; ?>