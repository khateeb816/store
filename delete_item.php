<?php
include './db.php';
$sql = "DELETE FROM cart WHERE `id` = {$_GET['id']}";
if($conn -> query($sql)){
    header("location:" . $_SERVER['HTTP_REFERER']);
}
?>