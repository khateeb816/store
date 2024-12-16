<?php 
$conn = new mysqli('localhost','root','','store');
if($conn -> connect_error){
    die("Error Connecting database");
}
?>