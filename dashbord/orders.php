<?php
include './includes/header.php';
include './includes/sidebar.php';
include './includes/navbar.php';
include '../db.php';

// Pagination setup
$orders_per_page = 10; // Number of orders per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $orders_per_page;

$sql_get = "SELECT * 
            FROM orders WHERE `user_id` = {$_SESSION['id']} 
            LIMIT $orders_per_page OFFSET $offset";

$sql_get_result = $conn->query($sql_get);
$Sno = $offset + 1;

?>

<div class="container-xxl position-relative bg-white d-flex p-3">
    <div class="container-fluid pt-4 px-4">

        <section class="">
            <div class="container py-5">
                <div class="row d-flex justify-content-center align-items-center">
                    <div class="col">
                        <div class="card" id="list1" style="border-radius: .75rem; background-color: #eff1f2;">
                            <div class="card-body py-4 px-4 px-md-5">
                                <p class="h1 text-center mt-3 mb-4 pb-3 text-primary">
                                    <u>Orders</u>
                                </p>
                                <hr class="my-4">
                                <table id="myTable" class="display" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th scope="col">S No.</th>
                                            <th scope="col">User Name</th>
                                            <th scope="col">Product Name</th>
                                            <th scope="col">Quantity</th>
                                            <th scope="col">Color</th>
                                            <th scope="col">Size</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Add Time</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $Sno = 0;
                                         while ($row = $sql_get_result->fetch_assoc()) {
                                            $Sno++;
                                            $uName = $row['f_name'] . ' ' . $row['l_name'];
                                            $items = (array) json_decode($row['items']);
                                            $item = $conn->query("SELECT `name` FROM `products` WHERE `id` = {$items[0]}");
                                            $item = $item->fetch_assoc();

                                        ?>
                                            <tr>
                                                <td scope='row'><?php echo $Sno; ?>:</td>
                                                <td><?php echo $uName; ?></td>
                                                <td><?php echo $item['name']; ?></td>
                                                <td><?php echo $row['quantity']; ?></td>
                                                <td><?php echo $row['colors']; ?></td>
                                                <td><?php echo $row['sizes']; ?></td>
                                                <td>
                                                    <select class="form-control form-control-lg" onchange="updateProductStatus(<?php echo $row['id']; ?>)" id="status-<?php echo $row['id']; ?>">
                                                        <option value="Pending" <?php echo ($row['status'] == 'Pending' ? 'selected' : ''); ?>>Pending</option>
                                                        <option value="Confirmed" <?php echo ($row['status'] == 'Confirmed' ? 'selected' : ''); ?>>Confirmed</option>
                                                        <option value="Cancelled" <?php echo ($row['status'] == 'Cancelled' ? 'selected' : ''); ?>>Cancelled</option>
                                                        <option value="Delivered" <?php echo ($row['status'] == 'Delivered' ? 'selected' : ''); ?>>Delivered</option>
                                                    </select>
                                                </td>
                                                <td><?php echo $row['added_at']; ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>

                                <!-- Pagination Controls -->
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination justify-content-center">
                                        <?php
                                        $sql_count = "SELECT COUNT(*) as total FROM orders";
                                        $result_count = $conn->query($sql_count);
                                        $row_count = $result_count->fetch_assoc();
                                        $total_pages = ceil($row_count['total'] / $orders_per_page);

                                        for ($i = 1; $i <= $total_pages; $i++) {
                                            $active_class = ($i === $page) ? 'active' : '';
                                            echo "<li class='page-item $active_class'><a class='page-link' href='?page=$i'>$i</a></li>";
                                        }
                                        ?>
                                    </ul>
                                </nav>

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

<script>
    function updateProductStatus(id) {
        let status = document.getElementById('status-' + id).value;
        window.location.href = "updateStatusOrder.php?status=" + encodeURIComponent(status) + "&id=" + encodeURIComponent(id);
    }
</script>

<?php include './includes/footer.php'; ?>