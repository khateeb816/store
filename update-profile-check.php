<?php
include './db.php';
$f_name = $_POST['f_name'];
$id = $_POST['id'];
$l_name = $_POST['l_name'];
$email = $_POST['email'];
$number = $_POST['number'];

$sql = "UPDATE `users` SET `f_name` = '$f_name', `l_name` = '$l_name' , `email` = '$email' , `number` = '$number' WHERE `id` = '$id'";
if($conn -> query($sql)){
    header("location:" . $_SERVER['HTTP_REFERER']);
}
?>