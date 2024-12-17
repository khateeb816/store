<?php 
include '.././db.php';
$sql = "SELECT * FROM `users` WHERE `role` = 1";
$sqlResult = $conn -> query($sql);
$user = $sqlResult -> fetch_assoc();
?>

<div class="sidebar pe-4 pb-3 z-1">
    <nav class="navbar bg-light navbar-light">
        <a href="index.html" class="navbar-brand mx-4 mb-3">
            <h3 class="text-primary"><i class="fa fa-hashtag me-2"></i>DASHMIN</h3>
        </a>
        <div class="d-flex align-items-center ms-4 mb-4">
            <div class="ms-3">
                <h6 class="mb-0"><?php echo $user['f_name'] . " " .$user['l_name']; ?></h6>
                <span>Admin</span>
            </div>
        </div>
        <div class="navbar-nav w-100">
            <a href="index.php" class="nav-item nav-link <?php echo (basename($_SERVER['PHP_SELF']) == "index.php"?'active':'');  ?>"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
            <a href="categories.php" class="nav-item nav-link <?php echo (basename($_SERVER['PHP_SELF']) == "categories.php" || basename($_SERVER['PHP_SELF']) == "update_category.php" ?'active':'');  ?>"><i class="fa fa-th me-2"></i>Categories</a>
            <a href="products.php" class="nav-item nav-link <?php echo (basename($_SERVER['PHP_SELF']) == "products.php" || basename($_SERVER['PHP_SELF']) == "update_product.php" || basename($_SERVER['PHP_SELF']) == "add_product.php" ?'active':'');  ?>"><i class="fa-solid fa-boxes-stacked"></i> &nbsp;Products</a>
            <a href="brands.php" class="nav-item nav-link <?php echo (basename($_SERVER['PHP_SELF']) == "brands.php" || basename($_SERVER['PHP_SELF']) == "update_brand.php" ?'active':'');  ?>""><i class="fa fa-table me-2"></i>Brands</a>
            <a href="orders.php" class="nav-item nav-link <?php echo (basename($_SERVER['PHP_SELF']) == "orders.php" ?'active':'');  ?>"><i class="fa fa-chart-bar me-2"></i>Orders</a>
            <a href="messages.php" class="nav-item nav-link <?php echo (basename($_SERVER['PHP_SELF']) == "messages.php" ?'active':'');  ?>"><i class="fa fa-chart-bar me-2"></i>Messages</a>
            <a href="live_chat.php" class="nav-item nav-link <?php echo (basename($_SERVER['PHP_SELF']) == "live_chat.php" ?'active':'');  ?>"><i class="fa fa-chart-bar me-2"></i>Live Chat</a>
        </div>
    </nav>
</div>