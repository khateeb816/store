<?php
include '../db.php';


$sqlGet = "SELECT * FROM products WHERE id = {$_GET['id']}";
$sqlGetResult = $conn->query($sqlGet);
$row = $sqlGetResult->fetch_assoc();
$oldImages = json_decode($row['images']);
$oldImages = (array) $oldImages;
$count = 0;
print_r($oldImages);
foreach ($oldImages as $image) {
    if ($image == $_GET['src']) {
        unset($oldImages[$count]);
    }
    $count++;
}
print_r($oldImages);
$newImages = array_values($oldImages);
$newImages = json_encode($newImages);

print_r($newImages);

$sqlUpdate = "UPDATE products SET images = '$newImages' WHERE id = {$_GET['id']}";
if ($conn->query($sqlUpdate) == TRUE) {

    unlink($_GET['src']);
    header("location:update_product.php?id=" . $_GET['id']);
}
