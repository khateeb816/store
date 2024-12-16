<?php 
include '../db.php';

$id = $_GET['id'];
$sql1 = "SELECT *FROM categories WHERE id = '$id'";
$sql1_result = $conn -> query($sql1);
$row = $sql1_result -> fetch_assoc();
$sql = "DELETE FROM categories WHERE id = '$id'";
if($conn -> query($sql) === TRUE){
    unlink($row['image_path']);
    header('location:categories.php');
}
else{
    echo "Delete Error..";
}

?>