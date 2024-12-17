<?php
include './includes/header.php';
include './db.php';

if (!isset($_SESSION['id'])) {
  echo ("<script>window.location.href= 'login.php';</script>");
  exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $msg = $_POST['message'];
  if ($conn->query("INSERT INTO `live_messages` (`message`, `user_id`) VALUES ('$msg', '{$_SESSION['id']}')")) {
    echo "<script>window.location.href= '{$_SERVER['PHP_SELF']}';</script>";
    exit;
  } else {
    echo "Error: " . $conn->error;
  }
}

?>
<div class="container my-4">
  <?php
  if (isset($_GET['msg'])) {
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

<!-- Updated CSS for live chat -->
<style>
  .floating-btn {
    position: fixed;
    bottom: 20px;
    right: 20px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 50%;
    width: 60px;
    height: 60px;
    display: flex;
    justify-content: center;
    align-items: center;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    cursor: pointer;
    z-index: 1000;
  }

  .floating-btn:hover {
    background-color: #0056b3;
  }

  #livechat {
    display: none;
    position: fixed;
    bottom: 0;
    right: 20px;
    width: 90%;
    max-width: 400px;
    height: 60%;
    background-color: white;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    border-radius: 15px 15px 0 0;
    z-index: 1001;
  }
</style>

<!-- Floating Button -->
<button class="floating-btn" id="toggleChat">
  💬
</button>
<!-- Live Chat Section -->
<section id="livechat">
  <div class="container h-100 py-3">
    <div class="row d-flex justify-content-center h-100">
      <div class="col-md-12">
        <div class="card" style="height: 100%;">
          <div
            class="card-header d-flex justify-content-between align-items-center p-3 bg-info text-white">
            <p class="mb-0 fw-bold">Live Chat</p>
            <i class="fas fa-times" id="closeChat" style="cursor: pointer;"></i>
          </div>
          <div class="card-body" id="chatBody" style="height: 300px; overflow-y: auto;">
            <?php
            $sql = $conn->query("SELECT * FROM `live_messages` WHERE `user_id` = '{$_SESSION['id']}' ORDER BY `id` ASC");
            while ($row = $sql->fetch_assoc()) {
              if ($row['role'] == 1) {
                // Admin Message
                echo "<div class='d-flex flex-row justify-content-start mb-4'>
              <div class='p-3 ms-3' style='border-radius: 15px; background-color: rgba(57, 192, 237, 0.2);'>
                <p class='small mb-0'>{$row['message']}</p>
              </div>
            </div>";
              } else {
                // User Message
                echo "<div class='d-flex flex-row justify-content-end mb-4'>
              <div class='p-3 me-3 border bg-body-tertiary' style='border-radius: 15px;'>
                <p class='small mb-0'>{$row['message']}</p>
              </div>
            </div>";
              }
            }
            ?>
          </div>

          <!-- JavaScript -->
          <script>
            window.onload = function() {
              const chatBody = document.getElementById("chatBody");
              chatBody.scrollTop = chatBody.scrollHeight; // Scroll to bottom
            };
          </script>

          <form action="" method="post" class="form-outline m-2">
            <textarea class="form-control bg-body-tertiary" id="textAreaExample" rows="4" name="message" placeholder="Type your message"></textarea>
            <button class="btn btn-primary my-2" type="submit">Send</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>


<script>
  const toggleChatBtn = document.getElementById('toggleChat');
  const liveChat = document.getElementById('livechat');
  const closeChat = document.getElementById('closeChat');
  if (localStorage.chat == 'open') {
    liveChat.style.display = 'block';

  }
  toggleChatBtn.addEventListener('click', () => {

    liveChat.style.display = 'block';
    localStorage.setItem('chat', 'open');

  });

  closeChat.addEventListener('click', () => {
    liveChat.style.display = 'none';
    localStorage.setItem('chat', 'close');

  });
</script>


<? include './includes/footer.php'; ?>