<?php
include './includes/header.php';
include './includes/sidebar.php';
include './includes/navbar.php';
include '../db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $categoryName = $_POST['name'];
    $description = $_POST['description'];
    $status = $_POST['status'];
    $newPath = "";

    if (isset($_FILES['image'])) {
        $tempPath = $_FILES['image']['tmp_name'];
        $name = $_FILES['image']['name'];
        $ext = pathinfo($name, PATHINFO_EXTENSION);
        $newName = uniqid() . "." . $ext;
        $newPath = './img/categories/' . $newName;
        if (move_uploaded_file($tempPath, $newPath)) {
            echo "File uploaded successfully.";
        } else {
            echo "Failed to upload file.";
        }
    }

    $sql = "INSERT INTO brands (name, image, status, description) VALUES ('$categoryName', '$newPath', '$status', '$description')";
    if ($conn->query($sql) === TRUE) {
        echo "Data inserted successfully.";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Fetch brands
$orders_per_page = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $orders_per_page;

$sql_get = "SELECT * FROM brands ORDER BY id ASC LIMIT $orders_per_page OFFSET $offset";
$sql_get_result = $conn->query($sql_get);

?>

<div class="container-xxl position-relative bg-white d-flex p-0">
    <div class="container-fluid pt-4 px-4">
        <section class="vh-100">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col">
                        <div class="card" id="list1" style="border-radius: .75rem; background-color: #eff1f2;">
                            <div class="card-body py-4 px-4 px-md-5">
                                <p class="h1 text-center mt-3 mb-4 pb-3 text-primary"><u>Brands</u></p>

                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="d-flex flex-row align-items-center">
                                        <input type="text" class="form-control form-control-lg" id="name" placeholder="Add brand..." name="name" required>
                                        <select name="status" class="form-control form-control-lg">
                                            <option value='Block'>Block</option>
                                            <option value='Allow'>Allow</option>
                                        </select>
                                        <input type="file" class="form-control form-control-lg" id="image" name="image" accept=".png,.jpg,.jpeg" required>
                                        <button type="submit" class="btn btn-primary mx-3">Add</button>
                                    </div><br>
                                    <textarea name="description" rows="5" placeholder="Write Description Here" required></textarea>
                                </form>

                                <hr class="my-4">
                                <table id="myTable" class="display" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>S No.</th>
                                            <th>Name</th>
                                            <th>Status</th>
                                            <th>Description</th>
                                            <th>Image</th>
                                            <th>Added at</th>
                                            <th>Options</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        while ($row = $sql_get_result->fetch_assoc()) {
                                            echo "
                                                    <tr>
                                                        <td >{$row['id']}</td>
                                                        <td>{$row['name']}</td>
                                                        <td>{$row['status']}</td>
                                                        <td>{$row['description']}</td>
                                                        <td><img src='{$row['image']}' style='width:100px;' alt='{$row['name']}'></td>
                                                        <td>{$row['added_at']}</td>
                                                        <td>
                                                            <div class='d-flex flex-row justify-content-end mb-1'>
                                                                <a href='update_category.php?id={$row['id']}' class='text-info' title='Edit'><i class='fas fa-pencil-alt me-3'></i></a>
                                                                <a href='delete_category.php?id={$row['id']}' class='text-danger' title='Delete'><i class='fas fa-trash-alt'></i></a>
                                                            </div>
                                                        </td>
                                                    </tr>";}
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

<?php include './includes/footer.php'; ?>