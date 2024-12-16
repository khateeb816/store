<?php
include './db.php';
session_start();
if (!isset($_SESSION['id'])) {
    echo ("<script>window.location.href= 'login.php';</script>");
    exit();
}
$f_name = $_POST['f_name'];
$l_name = $_POST['l_name'];
$number = $_POST['phoneNumber'];
$email = $_POST['email'];
$country = $_POST['country'];
$address = $_POST['address'];
$city = $_POST['city'];
$zip = $_POST['zip'];
$cardName = $_POST['cardName'];
$cardNumber = $_POST['cardNumber'];
$cardExp = $_POST['cardExp'];
$cardCvc = $_POST['cardCvc'];
$amount = $_POST['amount'];
$sizes = $_POST['sizes'];
$colors = $_POST['colors'];
$quantity = $_POST['quantity'];
$tracking_id = "T" . uniqid(). "v";


$sqlget = "SELECT * FROM `cart` WHERE `user_id` = '{$_SESSION['id']}'";
$sqlGetResult = $conn->query($sqlget);
$items = [];
while ($row = $sqlGetResult->fetch_assoc()) {
    $items[] = $row['Product_id'];
}
$items = json_encode($items);

$sql = "INSERT INTO `orders` (`f_name`, `l_name`, `phone_number`, `email`, `country`, `address`, `city`, `zip`, `card_name`, `card_number`, `card_exp`, `card_cvc`, `amount`, `items`, `user_id` , `tracking_id` , `quantity` , `sizes` , `colors`) 
VALUES 
('$f_name', '$l_name', '$number', '$email', '$country', '$address', '$city', '$zip', '$cardName', '$cardNumber', '$cardExp', '$cardCvc', '$amount', '$items', '{$_SESSION['id']}' , '$tracking_id' , '$quantity' , '$sizes' , '$colors')";


if ($conn->query($sql) == TRUE) {
    $sqlDeleteCartItem = "DELETE FROM `cart` WHERE `user_id` = '{$_SESSION['id']}'";
    if ($conn->query($sqlDeleteCartItem) == TRUE) {
        echo "<script>window.location.href = 'order-placed.php?id=$tracking_id';</script>";
        exit();
    }
}
