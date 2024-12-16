<?php 
include 'db.php';
session_start();
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = '$email'";
    $sql_result = $conn -> query($sql);
    if($sql_result -> num_rows > 0){
        $row = $sql_result -> fetch_assoc();
        if(password_verify($password , $row['password'])){
            $_SESSION['email'] = $email;
            $_SESSION['role'] = $row['role'];
            $_SESSION['id'] = $row['id'];
            $_SESSION['name'] = $row['f_name'] . " " .$row['l_name'];
            echo $_SESSION['role'];
            if($_SESSION['role'] === "1"){
                header("location:./dashbord/index.php");
            }
            else{
                header("location:./index.php");

            }
        }
        else{
            $msg = "Invalid Password";
            header('location:login.php?msg='.$msg);
        }
    }
    else{
        $msg = "Account Not Found";
        header('location:login.php?msg='.$msg);
    }
}
?>