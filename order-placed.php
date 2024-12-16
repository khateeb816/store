<?php
include './includes/header.php';
include './db.php';

if (!isset($_SESSION['id'])) {
    echo ("<script>window.location.href= 'login.php';</script>");
    exit();
}

$id = $_GET['id']; 

$sql = "SELECT * FROM `orders` WHERE `tracking_id` = '$id'";
$result = $conn->query($sql);
if (!$result || $result->num_rows == 0) {
    echo "Order not found!";
    exit();
}

$order = $result->fetch_assoc(); 

$productIds = json_decode($order['items'], true); 
if (!is_array($productIds)) {
    echo "No products found in the order!";
    exit();
}

$productDetails = [];
foreach ($productIds as $productId) {
    $sqlProduct = "SELECT `name`, `discounted_price` FROM `products` WHERE `id` = $productId";
    $productResult = $conn->query($sqlProduct);

    if ($productResult && $productResult->num_rows > 0) {
        $productDetails[] = $productResult->fetch_assoc();
    }
}

?>
<section class="h-100 h-custom" style="background-color: #eee;">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-8 col-xl-6">
                <div class="card border-top border-bottom border-3" style="border-color: #f37a27 !important;">
                    <div class="card-body p-5">

                        <h1 class="lead fw-bold mb-5" style="color: #f37a27; font-size: 2rem;">Your order has been placed successfully</h1>
                        <p class="lead fw-bold mb-5" style="color: #f37a27;">Purchase Receipt</p>

                        <div class="row">
                            <div class="col mb-3">
                                <p class="small text-muted mb-1">Date</p>
                                <p><?php echo $order['added_at']; ?></p>
                            </div>
                            <div class="col mb-3">
                                <p class="small text-muted mb-1">Order No.</p>
                                <p><?php echo $order['tracking_id']; ?></p>
                            </div>
                        </div>

                        <div class="mx-n5 px-5 py-4" style="background-color: #f2f2f2;">
                            <?php foreach ($productDetails as $product) { ?>
                                <div class="row">
                                    <div class="col-md-4 col-lg-8">
                                        <p><?php echo $product['name']; ?></p>
                                    </div>
                                    <div class="col-md-4 col-lg-2">
                                        <p><?php echo $order['quantity']; ?></p>
                                    </div>
                                    <div class="col-md-4 col-lg-2">
                                        <p><?php echo "$" . $product['discounted_price'] . ".0"; ?></p>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>

                        <div class="row my-4">
                            <div class="col-md-4 offset-md-8 col-lg-3 offset-lg-9">
                                <p class="lead fw-bold mb-0" style="color: #f37a27;"><?php echo "$" . $order['amount'] . ".0"; ?></p>
                            </div>
                        </div>

                        <p class="mt-4 pt-2 mb-0">Want any help? <a href="#!" style="color: #f37a27;">Please contact us</a></p>
                        <a href="./index.php" class="btn btn-warning mt-4 pt-2 mb-0">Home</a>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
