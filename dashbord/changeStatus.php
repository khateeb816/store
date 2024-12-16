<?php
include '../db.php';

if($conn -> query("UPDATE `messages` SET `status` = '{$_GET['status']}' WHERE `id` = '{$_GET['id']}'")){
    header("location:messages.php");
}
?>