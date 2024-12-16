<?php
session_start();
include './db.php';

$colors = $_POST['colors'];
$sizes = $_POST['sizes'];

if ($_POST['quantity'] > 0) {
    $sql = "INSERT INTO `cart` ( `Product_id` , `user_id` , `quantity` , `sizes` , `colors`) VALUES ( '{$_POST['Product_id']}' , '{$_SESSION['id']}' , '{$_POST['quantity']}' , '$sizes' , '$colors')";
    if ($conn->query($sql)) {
        header("location:" . $_SERVER['HTTP_REFERER']);
    }
} else {
    header("location:" . $_SERVER['HTTP_REFERER']);
}
