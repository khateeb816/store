<!DOCTYPE html>
<html lang="en">
<?php session_start();
include "./db.php";
?>

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ashion Template">
    <meta name="keywords" content="Ashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Online | Store</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cookie&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>


    <!-- Offcanvas Menu Begin -->
    <div class="offcanvas-menu-overlay"></div>
    <div class="offcanvas-menu-wrapper">
        <div class="offcanvas__close">+</div>
        <ul class="offcanvas__widget">
            <li><a href="wish_list.php"><i class="fa-solid fa-heart"></i>
                    <?php
                    if (isset($_SESSION['id'])) {

                        $sql = "SELECT * FROM `wish_list` WHERE `user_id` = {$_SESSION['id']}";
                        $sqlResult = $conn->query($sql);
                        echo "<div class='tip'>" . $sqlResult->num_rows . "</div>";
                    }
                    ?>
                </a></li>
            <li><a href="shop-cart.php"><i class="fa-solid fa-cart-shopping"></i>
                    <?php
                    if (isset($_SESSION['id'])) {

                        $sql = "SELECT * FROM `cart` WHERE `user_id` = {$_SESSION['id']}";
                        $sqlResult = $conn->query($sql);
                        echo "<div class='tip'>" . $sqlResult->num_rows . "</div>";
                    }
                    ?>
                </a></li>
            <li><a href="orders.php"><i class="fa-solid fa-bag-shopping"></i>
                    <?php
                    if (isset($_SESSION['id'])) {

                        $sql = "SELECT * FROM `orders` WHERE `user_id` = {$_SESSION['id']} AND `status` != 'Delivered'";
                        $sqlResult = $conn->query($sql);
                        echo "<div class='tip'>" . $sqlResult->num_rows . "</div>";
                    }
                    ?>
                </a></li>
        </ul>
        <div class="offcanvas__logo">
            <a href="./index.php"><h2>My Store</h2></a>
        </div>
        <div id="mobile-menu-wrap"></div>
        <div class="offcanvas__auth">
            <?php if (isset($_SESSION['name'])) {
                echo '<a href="./user_profile.php">' . $_SESSION['name'] . '</a>' . '&nbsp;&nbsp;<a href="./logout.php">Logout</a>';
            } else {
                echo "<a href='./login.php'>Login</a>
                <a href='./register.php'>Register</a>";
            }
            ?>
        </div>
    </div>
    <div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-3 col-lg-2">
                    <div class="header__logo">
                    <a href="./index.php"><h2>My Store</h2></a>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-7">
                    <nav class="header__menu">
                        <ul>
                            <li class="<?php echo basename($_SERVER['PHP_SELF']) == 'index.php'? 'active':''; ?>"><a href="./index.php">Home</a></li>
                            <li class="<?php echo basename($_SERVER['PHP_SELF']) == 'shop.php'? 'active':''; ?>"><a href="./shop.php">Shop</a></li>
                            <li class="<?php echo basename($_SERVER['PHP_SELF']) == 'contact.php'? 'active':''; ?>"><a href="./contact.php">Contact</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3">
                    <div class="header__right">
                        <div class="header__right__auth">
                            <?php if (isset($_SESSION['name'])) {
                                echo '<a href="./user_profile.php">' . $_SESSION['name'] . '</a>' . '&nbsp;&nbsp;<a href="./logout.php">Logout</a>';
                            } else {
                                echo "<a href='./login.php'>Login</a>
                                <a href='./register.php'>Register</a>";
                            }
                            ?>
                        </div>
                        <ul class="header__right__widget">
                            <li><a href="wish_list.php"><i class="fa-solid fa-heart"></i>
                                    <?php
                                    if (isset($_SESSION['id'])) {

                                        $sql = "SELECT * FROM `wish_list` WHERE `user_id` = {$_SESSION['id']}";
                                        $sqlResult = $conn->query($sql);
                                        echo "<div class='tip'>" . $sqlResult->num_rows . "</div>";
                                    }
                                    ?>
                                </a></li>
                            <li><a href="shop-cart.php"><i class="fa-solid fa-cart-shopping"></i>
                                    <?php
                                    if (isset($_SESSION['id'])) {

                                        $sql = "SELECT * FROM `cart` WHERE `user_id` = {$_SESSION['id']}";
                                        $sqlResult = $conn->query($sql);
                                        echo "<div class='tip'>" . $sqlResult->num_rows . "</div>";
                                    }
                                    ?>
                                </a></li>
                            <li><a href="orders.php"><i class="fa-solid fa-bag-shopping"></i>
                                    <?php
                                    if (isset($_SESSION['id'])) {

                                        $sql = "SELECT * FROM `orders` WHERE `user_id` = {$_SESSION['id']} AND `status` != 'Delivered'";
                                        $sqlResult = $conn->query($sql);
                                        echo "<div class='tip'>" . $sqlResult->num_rows . "</div>";
                                    }
                                    ?>
                                </a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="canvas__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </div>