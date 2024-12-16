<?php
include './db.php';
$id = $_GET['id'];
$sqlDel = "DELETE FROM `users` WHERE `id` = '$id'";
if($conn -> query($sqlDel)){
    header("location:logout.php");
}
?>