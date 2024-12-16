<?php
include '.././db.php';
$sql = "SELECT * FROM `users` WHERE `role` = 1";
$sqlResult = $conn->query($sql);
$user = $sqlResult->fetch_assoc();
?>
<nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
    <a href="#!" class="sidebar-toggler flex-shrink-0" onclick="toggleSidebar()">
        <i class="fa fa-bars"></i>
    </a>
    <div class="navbar-nav align-items-center ms-auto">
        <a href="./messages.php"><i class="fa-solid fa-message"></i>
            <?php
            if (isset($_SESSION['id'])) {

                $sql = "SELECT * FROM `messages` WHERE `status` = 'unread'";
                $sqlResult = $conn->query($sql);
                echo "<sup>" . $sqlResult->num_rows . "</sup>";
            }
            ?></a>
        <div class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                <span class="d-none d-lg-inline-flex"><?php echo $user['f_name'] . " " . $user['l_name']; ?></span>
            </a>
            <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                <a href=".././user_profile.php" class="dropdown-item">My Profile</a>
                <a href="../logout.php" class="dropdown-item">Log Out</a>
            </div>
        </div>
    </div>
</nav>