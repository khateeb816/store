<?php include './includes/header.php';

if (!isset($_SESSION['id'])) {
    echo ("<script>window.location.href= 'login.php';</script>");
    exit();
}

include './db.php';
$sql = "SELECT p.name, p.discounted_price, c.quantity, c.*
FROM products AS p
RIGHT JOIN cart AS c ON p.id = c.product_id
WHERE c.user_id = '{$_SESSION['id']}';
";


$sqlResult = $conn->query($sql);
$cart = [];
while ($row = $sqlResult->fetch_assoc()) {
    $cart[] = $row;
}
?>
<!-- Breadcrumb Begin -->
<div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__links">
                    <a href="./index.php"><i class="fa fa-home"></i> Home</a>
                    <span>Shopping cart</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Shop Cart Section Begin -->
<section class="shop-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="shop__cart__table">
                    <table>
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $subTotal = 0;
                            if (isset($_GET['v'])) {
                                $discount = $_GET['v'];
                            } else {

                                $discount = 0;
                            }
                            foreach ($cart as $item) {
                                $finalPrice = $item['discounted_price'] * $item['quantity'];
                                $subTotal += $finalPrice;
                                echo "<tr>
                                        <td class='cart__product__item'>
                                            <img src='img/shop-cart/cp-1.jpg' alt=''>
                                            <div class='cart__product__item__title'>
                                                <h6>{$item['name']}</h6>
                                                <div class='rating'>
                                                    <i class='fa fa-star'></i>
                                                    <i class='fa fa-star'></i>
                                                    <i class='fa fa-star'></i>
                                                    <i class='fa fa-star'></i>
                                                    <i class='fa fa-star'></i>
                                                </div>
                                            </div>
                                        </td>
                                        <td class='cart__price'>$ {$item['discounted_price']}.0</td>
                                        <td class='cart__quantity'>
                                            <div class='pro-qty'>
                                                <p style = 'margin-top:11px'>{$item['quantity']}</p>
                                            </div>
                                        </td>
                                        <td class='cart__total'>$ $finalPrice.0</td>
                                        <td class='cart__close'><a href = 'delete_item.php?id={$item['id']}' ><i class='fa-solid fa-trash text-dark'></i><a></td>
                                    </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="discount__content">
                    <h6>Discount codes</h6>
                    <form action="add_discount.php" method="post">
                        <input type="text" placeholder="Enter your coupon code" name="voucher">
                        <button type="submit" class="site-btn">Apply</button>
                    </form>
                    <?php 
                    if(isset($_GET['v'])){
                        echo "<div class='col-lg-4 offset-lg-2 mt-2'>
                                <div class='cart__total__procced'>
                                    <h6>Discount Added : $ {$_GET['v']}.0</h6>
                                </div>
                              </div>";
                    } elseif(isset($_GET['msg'])){
                        echo "<div class='col-lg-4 offset-lg-2 mt-2'>
                        <div class='cart__total__procced'>
                            <h6>{$_GET['msg']}</h6>
                        </div>
                      </div>";
                    }
                    ?>
                </div>
            </div>
            <div class="col-lg-4 offset-lg-2">
                <div class="cart__total__procced">
                    <h6>Cart total</h6>
                    <ul>
                        <li>Subtotal <span>$ <?php echo $subTotal; ?>.0</span></li>
                        <?php echo isset($_GET['v'])?  "<li>Discount <span>$ {$_GET['v']}.0</span></li>" : ""; ?>
                        
                        <li>Total <span>$ <?php echo ($subTotal - $discount); ?>.0</span></li>
                    </ul>
                    <a href="<?php echo (isset($_GET['v'])? "checkout.php?v=" .$_GET['v']: "checkout.php");?>" class="primary-btn">Proceed to checkout</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Shop Cart Section End -->

<?php include './includes/footer.php'; ?>