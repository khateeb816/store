<?php 
include './db.php';
$name = $_POST['name'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];

if ($conn -> query("INSERT INTO `messages` ( `name` , `email` , `subject` , `message` , 'user_id' ) VALUES ( '$name' , '$email' , '$subject' , '$message' , '{$_SESSION['id']}')")){
    $msg = "Message Submitted!!";
    header("location:contact.php?msg=" . $msg);
}
?>