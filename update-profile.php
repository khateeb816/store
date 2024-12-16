<?php
include './db.php';
$id = $_GET['id'];
$sql = "SELECT * FROM `users` WHERE `id` = '$id'";
$sqlResult = $conn -> query($sql);
$user = $sqlResult -> fetch_assoc();
?>
<?php include 'includes/header.php' ?>
<div class="container">
    <div class="row">
      <div class="col-md-6 offset-md-3">
        <h2 class="text-center text-dark mt-5">Update Profile</h2>
        <div class="card my-5">

          <form class="card-body cardbody-color p-lg-5" action = "update-profile-check.php" method = "POST">

            <div class="mb-3">
              <input type="text" class="form-control" id="fname" name = "f_name" aria-describedby="emailHelp"
                placeholder="First Name" value="<?php echo $user['f_name']?>">
              <input type="hidden" class="form-control" id="fname" name = "id" aria-describedby="emailHelp"
                placeholder="First Name" value="<?php echo $user['id']?>">
            </div>
            <div class="mb-3">
              <input type="text" class="form-control" id="lname" name = "l_name" aria-describedby="emailHelp"
                placeholder="Last Name" value="<?php echo $user['l_name']?>">
            </div>
            <div class="mb-3">
              <input type="email" class="form-control" id="email" name = "email" aria-describedby="emailHelp"
                placeholder="Email" value="<?php echo $user['email']?>">
            </div>
            <div class="mb-3">
              <input type="text" class="form-control" id="number" name = "number" aria-describedby="emailHelp"
                placeholder="Number" value="<?php echo $user['number']?>"">
            </div>
            <div class="text-center"><button type="submit" class="btn btn-color px-5 mb-5 w-100">Update</button></div>
            <div id="emailHelp" class="form-text text-center mb-5 text-dark"><a href="./index.php" class="text-dark fw-bold">Go Home</a>
            </div>
          </form>
        </div>

      </div>
    </div>
  </div>
<?php include 'includes/footer.php' ?>