<?php
include './includes/header.php';
include './db.php';

if (!isset($_SESSION['id'])) {
    echo ("<script>window.location.href= 'login.php';</script>");
    exit();
}


$sql = "SELECT * FROM `orders` WHERE `user_id` = '{$_SESSION['id']}' AND `status` != 'Delivered'";
$result = $conn->query($sql);
if (!$result || $result->num_rows == 0) {
    echo "Order not found!";
    exit();
}
$orders = [];
while($row = $result->fetch_assoc()){
    $orders[] = $row;
}

?>

<div class="container">
    <article class="card">
        <header class="card-header"> My Orders / Tracking </header>
        <div class="card-body">

            <ul class="row">
                <?php
                foreach ($orders as $order) {
                    $items = (array) json_decode($order['items']);
                    foreach($items as $item){
                        $sqlProduct = "SELECT `name`, `discounted_price` , `images` FROM `products` WHERE `id` = '$item'";
                        $sqlProductResult = $conn -> query($sqlProduct);
                        $product = $sqlProductResult -> fetch_assoc();
                        $image = (array) json_decode($product['images']);

                        echo "<li class='col-md-4'>
                            <figure class='itemside mb-3'>
                                <div class='aside'><img src='./dashbord/$image[0]' class='img-sm border'></div><br>
                                <h6>Order ID: {$order['tracking_id']}</h6><br>
                                <figcaption class='info align-self-center'>
                                    <p class='title'>Name: {$product['name']}</p> <span class='text-muted'>Price: $ {$product['discounted_price']}.0</span>
                                    <p>Status: {$order['status']}</p>
                                </figcaption>
                            </figure>
                        </li>";
                    }
                }
                ?>

            </ul>
            <hr>
            <h2>Delivered Items</h2>
            <ul class="row">
                <?php
                $sql = "SELECT * FROM `orders` WHERE `user_id` = '{$_SESSION['id']}' AND `status` = 'Delivered'";
                $result = $conn->query($sql);
                if (!$result || $result->num_rows == 0) {
                    echo "Order not found!";
                    exit();
                }
                $orders = [];
                while($row = $result->fetch_assoc()){
                    $orders[] = $row;
                }

                foreach ($orders as $order) {
                    $items = (array) json_decode($order['items']);
                    foreach($items as $item){
                        $sqlProduct = "SELECT `name`, `discounted_price` , `images` FROM `products` WHERE `id` = '$item'";
                        $sqlProductResult = $conn -> query($sqlProduct);
                        $product = $sqlProductResult -> fetch_assoc();
                        $image = (array) json_decode($product['images']);

                        echo "<li class='col-md-4'>
                            <figure class='itemside mb-3'>
                                <div class='aside'><img src='./dashbord/$image[0]' class='img-sm border'></div><br>
                                <h6>Order ID: {$order['tracking_id']}</h6><br>
                                <figcaption class='info align-self-center'>
                                    <p class='title'>Name: {$product['name']}</p> <span class='text-muted'>Price: $ {$product['discounted_price']}.0</span>
                                    <p>Status: {$order['status']}</p>
                                </figcaption>
                            </figure>
                        </li>";
                    }
                }
                ?>

            </ul>
            <a href="./index.php" class="btn btn-warning" data-abc="true"> <i class="fa fa-chevron-left"></i> Back to Home</a>
        </div>
    </article>
</div>