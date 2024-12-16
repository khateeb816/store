<?php
include './includes/header.php';
include './db.php';

if (!isset($_SESSION['id'])) {
    echo ("<script>window.location.href= 'login.php';</script>");
    exit();
}

?>
<div class="container my-4">
    <?php 
    if(isset($_GET['msg'])){
        echo "<h4 class = 'my-5'>{$_GET['msg']}</h4>";
    }
    ?>
    <form action="submit-message.php" method="post">
        <div class="form-group">
            <label for="exampleInputEmail1">Your Name</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Name" name="name" required>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="email" required>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Subject</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Subject here" name="subject" required>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Your Message</label>
            <textarea type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Your message here" name="message" required></textarea>
        </div>
        
        <button type="submit" class="btn btn-primary my-4">Submit</button>
    </form>
</div>

<? include './includes/footer.php'; ?>