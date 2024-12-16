<?php
include './includes/header.php';
include './includes/sidebar.php';
include './includes/navbar.php';
include '../db.php';

$sql = $conn->query("SELECT * FROM `messages`");
$messages = [];
while ($row = $sql->fetch_assoc()) {
    $messages[] = $row;
}

?>

<div class="container-xxl position-relative bg-white d-flex p-0">
    <div class="container-fluid pt-4 px-4">
        <section class="vh-100">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col">
                        <div class="card" id="list1" style="border-radius: .75rem; background-color: #eff1f2;">
                            <div class="card-body py-4 px-4 px-md-5">
                                <p class="h1 text-center mt-3 mb-4 pb-3 text-primary"><u>Messages</u></p>
                                <table id="myTable" class="display" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>S No.</th>
                                            <th>User Name</th>
                                            <th>Email</th>
                                            <th>Subject</th>
                                            <th>Message</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($messages as $message) {

                                            echo "<tr>
                                        <td id = 'msgId'>{$message['id']}</td>
                                        <td>{$message['name']}</td>
                                        <td>{$message['email']}</td>
                                        <td>{$message['subject']}</td>
                                        <td>{$message['message']}</td>
                                        <td>
                                            <select name='status' id='status' onchange = 'checkStatus()' class='form-control form-control-lg'>
                                                <option value='unread' " . ($message['status'] == 'unread' ? 'selected' : '') . ">unread</option>
                                                <option value='read' " . ($message['status'] == 'read' ? 'selected' : '') . ">read</option>
                                            </select>
                                        </td>
                                    </tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="bg-light rounded-top p-4">
            <div class="row">
                <div class="col-12 col-sm-6 text-center text-sm-start">
                    &copy; <a href="#">Your Site Name</a>, All Rights Reserved.
                </div>
                <div class="col-12 col-sm-6 text-center text-sm-end">
                    Designed By <a href="https://htmlcodex.com">HTML Codex</a><br>
                    Distributed By <a class="border-bottom" href="https://themewagon.com" target="_blank">ThemeWagon</a>
                </div>
            </div>
        </div>
    </div>
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
</div>

<script>
    function checkStatus() {
        let status = document.getElementById('status').value;
        let msgId = document.getElementById('msgId').innerText;
        window.location.href = 'changeStatus.php?status=' + status + "&id=" + msgId;
    }
</script>

<?php include './includes/footer.php'; ?>