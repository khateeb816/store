<?php
include './includes/header.php';
// include './includes/sidebar.php';
include './includes/navbar.php';
include '../db.php';


$id = $_GET['id'];
$sql = "SELECT * FROM categories WHERE id = '$id'";
$sql_result = $conn->query($sql);
$row = $sql_result->fetch_assoc();
$oldImage = $row['image_path'];

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $status_of = $_POST['status_of'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $updateId = $_POST['update_id'];

    if (isset($_FILES['updateImage']) && $_FILES['updateImage']['error'] === UPLOAD_ERR_OK) {

        $tmpName = $_FILES['updateImage']['tmp_name'];
        $fileName = $_FILES['updateImage']['name'];
        $ext = pathinfo($fileName, PATHINFO_EXTENSION);
        $newName = uniqid() . "." . $ext;
        $newPath = "./img/categories/" . $newName;
        if (move_uploaded_file($tmpName, $newPath)) {
            unlink($oldImage);
            echo 'file uploaded';
            $sql2 = "UPDATE categories SET name = ? , image_path = ? , status_of = ? , description = ? WHERE id = ?";
            $stmt = $conn->prepare($sql2);
            $stmt->bind_param("ssssi", $name, $newPath, $status_of, $description , $updateId);
            if ($stmt->execute()) {
                header("location:categories.php");
                exit();
            } else {
                error_log("Error in update query: " . $stmt->error);
                echo "Error updating the record. Please try again.";
            }
        } else {
            echo "Error Uploading File";
        }
    } else {

        $sql2 = "UPDATE categories SET name = ? , status_of = ? , description = ? WHERE id = ?";
        $stmt = $conn->prepare($sql2);
        $stmt->bind_param("sssi", $name, $status_of, $description , $updateId );
        if ($stmt->execute()) {

            echo '<script>window.location.href = "categories.php";</script>';

            exit();
        } else {
            error_log("Error in update query: " . $stmt->error);
            echo "Error updating the record. Please try again.";
        }
        die();
    }
} else {
    echo "Invalid input.";
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

                                <p class="h1 text-center mt-3 mb-4 pb-3 text-primary">
                                    <u>Update Category</u>
                                </p>
                                <h2>Current Image:</h2>
                                <img src="<?php echo $row['image_path'] ?>" style="width: 200px; margin:40px"><br>
                                <div class="pb-2">
                                    <div class="card">
                                        <div class="card-body">

                                            <form action="update_category.php?id=<?php echo htmlspecialchars($id); ?>" method="POST" enctype="multipart/form-data">
                                                <div class="d-flex flex-row align-items-center">
                                                    <input type="text" class="form-control form-control-lg" style="border: 1px solid black;"
                                                        id="name" value="<?php echo $row['name']; ?>" name="name" required>
                                                    <select class="form-control form-control-lg"
                                                        id="status_of" name="status_of">
                                                        <option value="Block" <?php echo $row['status_of'] === 'Block' ? 'selected' : ''; ?>>Block</option>
                                                        <option value="Allow" <?php echo $row['status_of'] === 'Allow' ? 'selected' : ''; ?>>Allow</option>
                                                    </select>
                                                    <input type="file" class="form-control form-control-lg"
                                                        id="updateImage" name="updateImage" accept="png/jpg/jpeg">
                                                    <input type="hidden" class="form-control form-control-lg"
                                                        id="updateId" value="<?php echo $id; ?>" name="update_id" required>
                                                    <button type="submit" data-mdb-button-init data-mdb-ripple-init
                                                        class="btn btn-primary mx-3">Update</button>
                                                </div><br>
                                                <div>
                                                    <textarea name="description" id="" cols="130" rows="5" placeholder="Write Description Here" required><?php echo $row['description']; ?></textarea>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="bg-light rounded-top p-4">
            <div class="row">
                <div class="col-12 col-sm-6 text-center text-sm-start">
                    &copy; <a href="#">Your Site Name</a>, All Right Reserved.
                </div>
                <div class="col-12 col-sm-6 text-center text-sm-end">
                    Designed By <a href="https://htmlcodex.com">HTML Codex</a>
                    </br>
                    Distributed By <a class="border-bottom" href="https://themewagon.com" target="_blank">ThemeWagon</a>
                </div>
            </div>
        </div>
    </div>
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
</div>

<?php include './includes/footer.php'; ?>