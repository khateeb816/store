<?php
include './includes/header.php';
include './db.php';

if (!isset($_SESSION['id'])) {
    echo ("<script>window.location.href= 'login.php';</script>");
    exit();
}

$sql = "SELECT 
        cart.*, 
        products.name, 
        products.discounted_price 
    FROM 
        cart
    INNER JOIN 
        products 
    ON 
        cart.product_id = products.id
    WHERE 
        cart.user_id = {$_SESSION['id']}
";

$sqlResult = $conn->query($sql);
$items = [];
while ($row = $sqlResult->fetch_assoc()) {
    $items[] = $row;
}
?>

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

<!-- Checkout Section Begin -->
<section class="checkout spad">
    <div class="container">
        <form action="place-order.php" method="POST" class="checkout__form">
            <div class="row">
                <div class="col-lg-8">
                    <h5>Billing detail</h5>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="checkout__form__input">
                                <p>First Name <span>*</span></p>
                                <input type="text" name="f_name">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="checkout__form__input">
                                <p>Last Name <span>*</span></p>
                                <input type="text" name="l_name">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="checkout__form__input">
                                <p>Country <span>*</span></p>
                                <input type="text" name="country">
                            </div>
                            <div class="checkout__form__input">
                                <p>Address <span>*</span></p>
                                <input type="text" placeholder="Street Address" name="address">
                            </div>
                            <div class="checkout__form__input">
                                <p>Town/City <span>*</span></p>
                                <input type="text" name="city">
                            </div>
                            <div class="checkout__form__input">
                                <p>Postcode/Zip <span>*</span></p>
                                <input type="text" name="zip">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="checkout__form__input">
                                <p>Phone <span>*</span></p>
                                <input type="text" name="phoneNumber">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="checkout__form__input">
                                <p>Email <span>*</span></p>
                                <input type="text" name="email">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="checkout__order">
                        <h5>Your order</h5>
                        <div class="checkout__order__product">
                            <ul>
                                <li>
                                    <span class="top__text">Product</span>
                                    <span class="top__text">&nbsp;&nbsp;&nbsp;Quantity</span>
                                    <span class="top__text__right">Total</span>
                                </li>
                                <?php
                                $count = 1;
                                $subTotal = 0;
                                if (isset($_GET['v'])) {
                                    $discount = $_GET['v'];
                                } else {
                                    $discount = 0;
                                }
                                foreach ($items as $item) {
                                    $prodFinalPrice = $item['discounted_price'] * $item['quantity'];
                                    $subTotal += $prodFinalPrice;
                                    echo "<li>$count. {$item['name']} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{$item['quantity']} <span>$ $prodFinalPrice.0</span></li>";
                                }
                                ?>
                            </ul>
                        </div>
                        <div class="checkout__order__total">
                            <ul>
                                <li>Subtotal <span>$ <?php echo $subTotal; ?>.0</span></li>
                                <?php echo isset($_GET['v']) ? "<li>Discount <span>$ $discount.0</span></li>" : ""; ?>
                                <li>Total <span>$ <?php echo $subTotal - $discount; ?>.0</span></li>
                                <input class="form-control mb-3" type="hidden" placeholder="Name" name="amount" value="<?php echo $subTotal - $discount; ?>">
                                <input class="form-control mb-3" type="hidden" placeholder="quantity" name="quantity" value="<?php echo $item['quantity']; ?>">
                                <input class="form-control mb-3" type="hidden" placeholder="quantity" name="colors" value="<?php echo $item['colors']; ?>">
                                <input class="form-control mb-3" type="hidden" placeholder="quantity" name="sizes" value="<?php echo $item['sizes']; ?>">

                            </ul>
                        </div>
                        <div class="checkout__order__widget row d-flex">
                            <div class="container p-0">
                                <div class="card px-4">
                                    <p class="h8 py-3">Payment Details</p>
                                    <div class="row gx-3">
                                        <div class="col-12">
                                            <div class="d-flex flex-column">
                                                <p class="text mb-1">Person Name</p>
                                                <input class="form-control mb-3" type="text" placeholder="Name" name="cardName">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="d-flex flex-column">
                                                <p class="text mb-1">Card Number</p>
                                                <input class="form-control mb-3" type="text" placeholder="1234 5678 435678" name="cardNumber">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="d-flex flex-column">
                                                <p class="text mb-1">Expiry</p>
                                                <input class="form-control mb-3" type="text" placeholder="MM/YYYY" name="cardExp">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="d-flex flex-column">
                                                <p class="text mb-1">CVV/CVC</p>
                                                <input class="form-control mb-3 pt-2 " type="password" placeholder="***" name="cardCvc">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="site-btn">Place oder</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
<!-- Checkout Section End -->

<?php include './includes/footer.php' ?>