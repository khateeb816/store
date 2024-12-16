<?php 
include './includes/header.php'; 
include './includes/sidebar.php'; 
include './includes/navbar.php'; 
include '../db.php';

$sqlCounts = "
    SELECT 
        (SELECT COUNT(*) FROM `categories`) AS totalCategories,
        (SELECT COUNT(*) FROM `products`) AS totalProducts,
        (SELECT COUNT(*) FROM `brands`) AS totalBrands,
        (SELECT COUNT(*) FROM `orders`) AS totalOrders,
        (SELECT COUNT(*) FROM `orders` WHERE DATE(`added_at`) = CURDATE()) AS todayOrders,
        (SELECT COUNT(*) FROM `orders` WHERE `status` = 'Pending') AS pendingOrders,
        (SELECT COALESCE(SUM(`amount`), 0) FROM `orders` WHERE `status` = 'Delivered') AS confirmedSale,
        (SELECT COALESCE(SUM(`amount`), 0) FROM `orders`) AS allOrdersworth,
        (SELECT COALESCE(SUM(`amount`), 0) FROM `orders` WHERE `status` != 'Delivered') AS pendingOrdersWorth
";

$sqlCountsResult = $conn->query($sqlCounts);
if (!$sqlCountsResult) {
    die("Database query failed: " . $conn->error);
}
$counts = $sqlCountsResult->fetch_assoc();

function renderCard($link, $icon, $label, $count) {
    return "
        <div class='col-12 col-md-6 col-xl-4'>
            <a href='{$link}' class='bg-light rounded d-flex align-items-center justify-content-between p-4'>
                <i class='{$icon} fa-3x text-primary'></i>
                <div class='ms-3'>
                    <p class='mb-2'>{$label}</p>
                    <h6 class='mb-0'>{$count}</h6>
                </div>
            </a>
        </div>
    ";
}
?>

<div class="content">
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <?php 
            echo renderCard('./categories.php', 'fa-solid fa-table-cells', 'Total Categories', $counts['totalCategories']);
            echo renderCard('./products.php', 'fa fa-chart-bar', 'Total Products', $counts['totalProducts']);
            echo renderCard('./brands.php', 'fa fa-chart-area', 'Total Brands', $counts['totalBrands']);
            echo renderCard('./orders.php', 'fa-brands fa-first-order-alt', 'Total Orders', $counts['totalOrders']);
            echo renderCard('./orders.php', 'fa-brands fa-first-order-alt', 'Today Orders', $counts['todayOrders']);
            echo renderCard('./orders.php', 'fa-brands fa-first-order-alt', 'Pending Orders', $counts['pendingOrders']);
            echo renderCard('./orders.php', 'fa-solid fa-file-invoice-dollar', 'Confirmed Sale', $counts['confirmedSale']);
            echo renderCard('./orders.php', 'fa-solid fa-file-invoice-dollar', 'Total Orders Worth', $counts['allOrdersworth']);
            echo renderCard('./orders.php', 'fa-solid fa-file-invoice-dollar', 'Pending Orders Worth', $counts['pendingOrdersWorth']);
            ?>
        </div>
    </div>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <div class="container-fluid pt-4 px-4">
            <div class="bg-light rounded-top p-4">
                <div class="row">
                    <div class="col-12 col-sm-6 text-center text-sm-start">
                        &copy; <a href="#">Your Site Name</a>, All Right Reserved.
                    </div>
                    <div class="col-12 col-sm-6 text-center text-sm-end">
                        Designed By <a href="https://htmlcodex.com">HTML Codex</a>
                        <br>
                        Distributed By <a class="border-bottom" href="https://themewagon.com" target="_blank">ThemeWagon</a>
                    </div>
                </div>
            </div>
        </div>
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>
</div>

<?php include './includes/footer.php'; ?>
