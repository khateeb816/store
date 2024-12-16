<?php
include './includes/header.php';
include './includes/sidebar.php';
include './includes/navbar.php';
include '../db.php';

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; 

$sql_get = "SELECT * FROM products";
$sql_get_result = $conn->query($sql_get);

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
                                    <u>Products</u>
                                </p>

                                <div class="pb-2">
                                    <a href="add_product.php" class="btn btn-primary mx-3">Add Product</a>
                                </div>

                                <hr class="my-4">

                                <div class="d-flex justify-content-end align-items-center mb-4 pt-2 pb-3">
                                    <p class="small mb-0 ms-4 me-2 text-muted">Sort</p>
                                    <a href="#!" style="color: #23af89;" data-mdb-tooltip-init title="Ascending"><i
                                            class="fas fa-sort-amount-down-alt ms-2"></i></a>
                                </div>
                                <table id="myTable" class="display" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th scope="col">S No.</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Show at</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">picture</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $Sno = 0;
                                    while ($row = $sql_get_result->fetch_assoc()) {
                                        $images = json_decode($row['images']);
                                        $description = $row['description'];
                                        $shortDescription = substr($description, 0, 20);
                                        $Sno++;
                                        echo "
                                        <tr>
                                            <td scope='row'>$Sno</td>
                                            <td scope='row'>{$row['name']}</td>
                                            <td scope='row'>{$row['quantity']}</td>
                                            <td scope='row'>{$row['show']}</td>
                                            <td scope='row'>{$row['status']}</td>
                                            <td scope='row'><img src={$images[0]} style = 'width: 70px;'></td>
                                            <td scope='row'><a href='../product-details.php?id={$row['id']}' class='btn btn-primary'>Details</a>
                                            <a href='update_product.php?id={$row['id']}' class='btn btn-info'>Update</a>
                                            <a href='delete_product.php?id={$row['id']}' class='btn btn-danger'>Delete</a></td>
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
