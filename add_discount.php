<?php 
include './db.php';
$voucher = $_POST['voucher'];
$sql = "SELECT * FROM `vouchers` WHERE `voucher` = '$voucher'";
$sqlResult = $conn -> query($sql);
if($sqlResult -> num_rows > 0){
    $row = $sqlResult->fetch_assoc();
    header("location: shop-cart.php?v={$row['discount']}");
    exit();
}else{
    header("location: shop-cart.php?msg=Invalid%20Code");
    exit();
}
?>