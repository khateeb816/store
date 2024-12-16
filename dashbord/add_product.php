<?php
include './includes/header.php';
include './includes/sidebar.php';
include './includes/navbar.php';
include '../db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $prodName = $_POST['name'];
    $quantity = $_POST['quantity'];
    $images = [];

    if (isset($_FILES['image'])) {
        for ($x = 0; $x < count($_FILES['image']['name']); $x++) {
            $tmppath = $_FILES['image']['tmp_name'][$x];
            $name = $_FILES['image']['name'][$x];
            $ext = pathinfo($name, PATHINFO_EXTENSION);
            $newName = uniqid() . "." . $ext;
            $newPath = "./img/products/" . $newName;
            if (move_uploaded_file($tmppath, $newPath)) {
                $images[] = $newPath;
            }
        }
    }

    $orignalPrice = $_POST['orignalPrice'];
    $discountedPrice = $_POST['discountedPrice'];
    $status = $_POST['status'];
    $show = $_POST['show'];

    $colors = ['colorBlack' => FALSE, 'colorBlue' => FALSE, 'colorGreen' => FALSE, 'colorRed' => FALSE, 'colorYellow' => FALSE, 'colorBrown' => FALSE];


    if (isset($_POST['colorBlack'])) {
        $colors['colorBlack'] = TRUE;
    }
    if (isset($_POST['colorBlue'])) {
        $colors['colorBlue'] = TRUE;
    }
    if (isset($_POST['colorGreen'])) {
        $colors['colorGreen'] = TRUE;
    }
    if (isset($_POST['colorRed'])) {
        $colors['colorRed'] = TRUE;
    }
    if (isset($_POST['colorYellow'])) {
        $colors['colorYellow'] = TRUE;
    }
    if (isset($_POST['colorBrown'])) {
        $colors['colorBrown'] = TRUE;
    }

    $sizes = ['XS' => FALSE, 'S' => FALSE, 'M' => FALSE, 'L' => FALSE, 'XL' => FALSE, 'XXL' => FALSE];

    if (isset($_POST['sizeXS'])) {
        $sizes['XS'] = TRUE;
    }
    if (isset($_POST['sizeS'])) {
        $sizes['S'] = TRUE;
    }
    if (isset($_POST['sizeM'])) {
        $sizes['M'] = TRUE;
    }
    if (isset($_POST['sizeL'])) {
        $sizes['L'] = TRUE;
    }
    if (isset($_POST['sizeXL'])) {
        $sizes['XL'] = TRUE;
    }
    if (isset($_POST['sizeXXL'])) {
        $sizes['XXL'] = TRUE;
    }
    $sizes = json_encode($sizes);
    $colors = json_encode($colors);
    $images = json_encode($images);
    $promotionPercentage = $_POST['promotionPercentage'];
    $promotionName = $_POST['promotionName'];
    $description = $_POST['description'];
    $specification = $_POST['specification'];
    $brandId = $_POST['brand'];
    $categoryId = $_POST['category'];

    $promotion = ['promotionPercentage' => $promotionPercentage, 'promotionName' => $promotionName];
    $promotion = json_encode($promotion);

    $sqlAddProduct = "INSERT INTO products 
            (name, quantity, images, orignal_price, discounted_price, status, colors, sizes, promotion, description, specification , `show` , `brand_id` , `category_id`) 
        VALUES 
            ('$prodName', '$quantity', '$images', '$orignalPrice', '$discountedPrice', '$status', '$colors', '$sizes', '$promotion', '$description', '$specification' , '$show' , '$brandId' , ' $categoryId' )";
    if ($conn->query($sqlAddProduct) == TRUE) {
        echo "<script> window.location.href = 'products.php';</script>";
    }
}
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
                                    <u>Add Product</u>
                                </p>

                                <div class="pb-2">
                                    <div class="card">
                                        <div class="card-body">
                                            <form action="" method="post" enctype="multipart/form-data">
                                                <div class="align-items-center">
                                                    <input type="text" class="form-control form-control-lg" style="border: 1px solid black;"
                                                        id="name" placeholder=" Name..." name="name">
                                                    <div class="d-flex flex-row align-items-center my-2">
                                                        <input type="number" class="form-control form-control-lg mx-2" style="border: 1px solid black;"
                                                            id="quantity" placeholder="Quantity" name="quantity" required>
                                                        <input type="file" class="form-control form-control-lg mx-2"
                                                            id="image" name="image[]" accept=".png,.jpg,.jpeg" multiple required> <br>
                                                    </div>
                                                    <div class="d-flex flex-row align-items-center my-2">
                                                        <input type="number" class="form-control form-control-lg mx-2" style="border: 1px solid black;"
                                                            id="quantity" placeholder="Orignal Price" name="orignalPrice" required>
                                                        <input type="number" class="form-control form-control-lg mx-2" style="border: 1px solid black;"
                                                            id="quantity" placeholder="Discounted Price" name="discountedPrice" required>
                                                    </div>
                                                    <select name="status" id="status" class="form-control form-control-lg mx-2 mr-4">
                                                        <option value=''>Select Status</option>

                                                        <option value="Allow">Allow</option>
                                                        <option value="Block">Block</option>
                                                    </select>
                                                    <select name="show" id="show" class="form-control form-control-lg mx-2 mr-4">
                                                        <option value=''>Select Show at</option>

                                                        <option value="None">None</option>
                                                        <option value="New">New</option>
                                                        <option value="Featured">Featured</option>
                                                        <option value="Hot">Hot</option>
                                                        <option value="Best">Best Seller</option>
                                                    </select>
                                                    <select name="brand" id="brand" class="form-control form-control-lg mx-2 mr-4">
                                                        <option value=''>Select Brand</option>
                                                        <?php
                                                        $sql_add_brand = "SELECT * FROM brands WHERE `status` = 'Allow'";
                                                        $sql_add_brand_Result = $conn->query($sql_add_brand);
                                                        $brands = [];
                                                        while ($row = $sql_add_brand_Result->fetch_assoc()) {
                                                            $brands[] = $row;
                                                        }
                                                        foreach ($brands as $brand) {
                                                            echo "<option value='{$brand['id']}'>{$brand['name']}</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                    <select name="category" id="category" class="form-control form-control-lg mx-2 mr-4">
                                                        <option value=''>Select Category</option>
                                                        <?php
                                                        $sql_add_category = "SELECT * FROM `categories` WHERE `status_of` = 'Allow'";
                                                        $sql_add_category_Result = $conn->query($sql_add_category);
                                                        $categories = [];
                                                        while ($row = $sql_add_category_Result->fetch_assoc()) {
                                                            $categories[] = $row;
                                                        }
                                                        foreach ($categories as $category) {
                                                            echo "<option value='{$category['id']}'>{$category['name']}</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                    <h3 class="mx-3 my-2" style="color: gray;">Select Colors:</h3>
                                                    <div class="d-flex flex-row align-items-center my-2 mx-2">

                                                        <input type="checkbox" class=" mx-2" style="border: 1px solid black;"
                                                            id="quantity" placeholder="Quantity" name="colorBlack" value="Black"> <label for="Black">Black</label>
                                                        <input type="checkbox" class=" mx-2" style="border: 1px solid black;"
                                                            id="quantity" placeholder="Quantity" name="colorBlue" value="Blue"> <label for="Blue">Blue</label>
                                                        <input type="checkbox" class=" mx-2" style="border: 1px solid black;"
                                                            id="quantity" placeholder="Quantity" name="colorGreen" value="Green"> <label for="Green">Green</label>
                                                        <input type="checkbox" class=" mx-2" style="border: 1px solid black;"
                                                            id="quantity" placeholder="Quantity" name="colorRed" value="Red"> <label for="Red">Red</label>
                                                        <input type="checkbox" class=" mx-2" style="border: 1px solid black;"
                                                            id="quantity" placeholder="Quantity" name="colorYellow" value="Yellow"> <label for="Yellow">Yellow</label>
                                                        <input type="checkbox" class=" mx-2" style="border: 1px solid black;"
                                                            id="quantity" placeholder="Quantity" name="colorBrown" value="Brown"> <label for="Brown">Brown</label>
                                                    </div>
                                                    <h3 class="mx-3 my-2" style="color: gray;">Select Size:</h3>
                                                    <div class="d-flex flex-row align-items-center my-2 mx-2">

                                                        <input type="checkbox" class=" mx-2" style="border: 1px solid black;"
                                                            id="quantity" placeholder="Quantity" name="sizeXS" value="XS"> <label for="XS">XS</label>
                                                        <input type="checkbox" class=" mx-2" style="border: 1px solid black;"
                                                            id="quantity" placeholder="Quantity" name="sizeS" value="S"> <label for="S">S</label>
                                                        <input type="checkbox" class=" mx-2" style="border: 1px solid black;"
                                                            id="quantity" placeholder="Quantity" name="sizeM" value="M"> <label for="M">M</label>
                                                        <input type="checkbox" class=" mx-2" style="border: 1px solid black;"
                                                            id="quantity" placeholder="Quantity" name="sizeL" value="L"> <label for="L">L</label>
                                                        <input type="checkbox" class=" mx-2" style="border: 1px solid black;"
                                                            id="quantity" placeholder="Quantity" name="sizeXL" value="XL"> <label for="XL">XL</label>
                                                        <input type="checkbox" class=" mx-2" style="border: 1px solid black;"
                                                            id="quantity" placeholder="Quantity" name="sizeXXL" value="XXL"> <label for="XXL">XXL</label>
                                                    </div>
                                                    <h4 class="mx-3 my-2" style="color: gray;">Add Promotion (if any):</h4>
                                                    <div class=" align-items-center my-2">
                                                        <div class="d-flex flex-row align-items-center my-2"> <input type="number" class="form-control form-control-lg mx-2" style="border: 1px solid black;"
                                                                id="quantity" placeholder="Discount Percentage" name="promotionPercentage"><label for="%">%</label></div>
                                                        <input type="text" class="form-control form-control-lg mx-2"
                                                            id="image" name="promotionName" placeholder="Promotion Name.." style="border: 1px solid black;"> <br>
                                                    </div>

                                                </div><br>
                                                <div>
                                                    <textarea required name="description" id="" cols="30" class="my-2 form-control form-control-lg mx-2" rows="5" placeholder="Write Product Description Here" style="border: 1px solid black;"></textarea>
                                                    <textarea required name="specification" id="" cols="30" class="my-2 form-control form-control-lg mx-2" rows="5" placeholder="Write Product specification Here" style="border: 1px solid black;"></textarea>
                                                </div>
                                                <button type="submit" data-mdb-button-init data-mdb-ripple-init
                                                    class="btn btn-primary" style="margin-left: 45%;">Submit</button>
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