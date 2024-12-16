<?php
include './includes/header.php';
include './includes/sidebar.php';
include './includes/navbar.php';
include '../db.php';

// Pagination settings
$categories_per_page = 10; // Number of categories per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Current page number
$offset = ($page - 1) * $categories_per_page;

// Fetch categories with pagination
$sql_get = "SELECT * FROM categories LIMIT $categories_per_page OFFSET $offset";
$sql_get_result = $conn->query($sql_get);
$Sno = $offset + 1; // Starting Serial Number
?>

<div class="container-xxl position-relative bg-white d-flex p-0">
    <div class="container-fluid pt-4 px-4">

        <section class="">
            <div class="container py-5 ">
                <div class="row d-flex justify-content-center align-items-center ">
                    <div class="col">
                        <div class="card" id="list1" style="border-radius: .75rem; background-color: #eff1f2;">
                            <div class="card-body py-4 px-4 px-md-5">

                                <p class="h1 text-center mt-3 mb-4 pb-3 text-primary">
                                    <u>Categories</u>
                                </p>

                                <div class="pb-2">
                                    <div class="card">
                                        <div class="card-body">
                                            <form action="" method="post" enctype="multipart/form-data">
                                                <div class="d-flex flex-row align-items-center">
                                                    <input type="text" class="form-control form-control-lg" style="border: 1px solid black;" id="name" placeholder="Add Category..." name="name" required>
                                                    <select name="status" class="form-control form-control-lg">
                                                        <option value='Block'>Block</option>
                                                        <option value='Allow'>Allow</option>
                                                    </select>
                                                    <input type="file" class="form-control form-control-lg" id="image" placeholder="Add Category..." name="image" accept=".png,.jpg,.jpeg" required> <br>
                                                    <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary mx-3">Add</button>
                                                </div><br>
                                                <div>
                                                    <textarea name="description" id="" rows="5" placeholder="Write Description Here" required></textarea>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <hr class="my-4">

                                <div class="d-flex justify-content-end align-items-center mb-4 pt-2 pb-3">
                                    <p class="small mb-0 ms-4 me-2 text-muted">Sort</p>
                                    <a href="#!" style="color: #23af89;" data-mdb-tooltip-init title="Ascending"><i class="fas fa-sort-amount-down-alt ms-2"></i></a>
                                </div>
                                <table id="myTable">
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
                                        $Sno = 0;
                                        while ($row = $sql_get_result->fetch_assoc()) {
                                            $Sno++;
                                            echo "
                                                    <tr>
                                                        <td >$Sno :</td>
                                                        <td>{$row['status_of']}</td>
                                                        <td>{$row['name']}</td>
                                                        <td>{$row['description']}</td>
                                                        <td><img src='{$row['image_path']}' style='width:100px;'></td>
                                                        <td>{$row['add_time']}</td>
                                                        <td>
                                                            <div class='d-flex flex-row justify-content-end mb-1'>
                                                                <a href='update_category.php?id={$row['id']}' class='text-info' data-mdb-tooltip-init title='Edit todo'>
                                                                    <i class='fas fa-pencil-alt me-3'></i>
                                                                </a>
                                                                <a href='delete_category.php?id={$row['id']}' class='text-danger' data-mdb-tooltip-init title='Delete todo'>
                                                                    <i class='fas fa-trash-alt'></i>
                                                                </a>
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
                    &copy; <a href="#">Your Site Name</a>, All Right Reserved.
                </div>
                <div class="col-12 col-sm-6 text-center text-sm-end">
                    Designed By <a href="https://htmlcodex.com">HTML Codex</a>
                    <br>
                    Distributed By <a class="border-bottom" href="https://themewagon.com" target="_blank">ThemeWagon</a>
                </div>
            </div>
        </div>
    </div>
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
</div>

<?php include './includes/footer.php'; ?>