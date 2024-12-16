<?php
include '../db.php';
$status = $_GET['status'];
$id = $_GET['id'];
$sql = "UPDATE `orders` SET `status` = '$status' WHERE `id` = '$id'";
if($conn -> query($sql)){
header("location:orders.php");
}
?>