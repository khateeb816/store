<?php 
include './db.php';
$sql = "INSERT INTO `wish_list` ( Product_id , user_id ) VALUES ( '{$_GET['product']}' , '{$_GET['user']}')";
if($conn -> query($sql)){
    header("Location: " . $_SERVER['HTTP_REFERER']);
}

?>