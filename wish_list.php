<?php include './includes/header.php';
include "./db.php";

if (!isset($_SESSION['id'])) {
    echo("<script>window.location.href= 'login.php';</script>");
    exit();
}
$sql = "SELECT w.*, p.* FROM `wish_list` AS w LEFT JOIN `products` AS p ON w.`product_id` = p.`id` WHERE `user_id` = '{$_SESSION['id']}'";
$sqlFullResult = $conn->query($sql);
$wish_list = [];
while ($row = $sqlFullResult->fetch_assoc()) {
    $wish_list[] = $row;
}



?>
<div class="container">
    <div class="row property__gallery">
        <?php
        if($sqlFullResult->num_rows == 0){
            echo "<h2 style = 'margin-left: 30%; margin-top: 20rem;'>Nothing is favourited yet</h2>";
        }
        foreach ($wish_list as $list) {
            $image = json_decode($list['images']);
            $image = (array) $image;
            $path = htmlspecialchars($image[0]);
            echo "              
                <div class='col-lg-3 col-md-4 col-sm-6 mix women'>
                    <div class='product__item'>
                        <div class='product__item__pic set-bg'  style='background-image: url(" . "./dashbord/" . $path . ");'>
                            <ul class='product__hover'>
                                <li>
                                    <a href='" . (isset($_SESSION['email'])
                ? "remove_from_favourite.php?product={$list['id']}"
                : 'login.php') . "'>
                                        <i class='fa-solid fa-xmark'></i>
                                    </a>
                                </li>
                                <li>
                                    <a href='./product-details.php?id={$list['id']}'>
                                        <i class='fa-solid fa-maximize'></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class='product__item__text'>
                            <h6><a href='#'>{$list['name']}</a></h6>
                            <div class='rating'>
                                <i class='fa fa-star'></i>
                                <i class='fa fa-star'></i>
                                <i class='fa fa-star'></i>
                                <i class='fa fa-star'></i>
                                <i class='fa fa-star'></i>
                            </div>
                            <div class='product__price'>$ {$list['discounted_price']}.0</div>
                        </div>
                    </div>
                </div>
                ";
        }
        ?>
    </div>
</div>