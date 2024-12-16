<?php 
include '../db.php';

$id = $_GET['id'];
$sql1 = "SELECT *FROM products WHERE id = '$id'";
$sql1_result = $conn -> query($sql1);
$row = $sql1_result -> fetch_assoc();
$sql = "DELETE FROM products WHERE id = '$id'";
$images = json_decode($row['images']);
$images = (array) $images;
if($conn -> query($sql) === TRUE){
    foreach($images as $image){
        unlink($image);
    }
    header('location:products.php');
}
else{
    echo "Delete Error..";
}

?>