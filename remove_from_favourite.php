<?php 
include "./db.php";
session_start();
$sql = "DELETE FROM `wish_list` WHERE `Product_id` = {$_GET['product']} AND `user_id` =  {$_SESSION['id']}";
if($conn -> query($sql)){
    header("location:" . $_SERVER['HTTP_REFERER']);
}
?>