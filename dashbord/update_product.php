<?php
include './includes/header.php';
include './includes/sidebar.php';
include './includes/navbar.php';
include '../db.php';


$sql_get = "SELECT * FROM products WHERE id = {$_GET['id']}";
$sql_get_result = $conn->query($sql_get);
$oldResults = $sql_get_result->fetch_array();
$oldColors = json_decode($oldResults['colors']);
$oldColors = (array) $oldColors;

$oldSizes = json_decode($oldResults['sizes']);
$oldSizes = (array) $oldSizes;

$oldImages = json_decode($oldResults['images']);
$oldImages = (array) $oldImages;

$oldPromotion = json_decode($oldResults['promotion']);
$oldPromotion = (array) $oldPromotion;

$images = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $prodName = $_POST['name'];
    $quantity = $_POST['quantity'];

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
    $promotionPercentage = $_POST['promotionPercentage'];
    $promotionName = $_POST['promotionName'];
    $description = $_POST['description'];
    $specification = $_POST['specification'];
    $brandId = $_POST['brand'];
    $categoryId = $_POST['category'];

    $promotion = ['promotionPercentage' => $promotionPercentage, 'promotionName' => $promotionName];
    $promotion = json_encode($promotion);

    if (isset($_FILES['image'])) {
        $Newimages = array_merge($images, $oldImages);
        $Newimages = json_encode($Newimages);
        $sqlAddProduct = "UPDATE products SET name = '$prodName', `brand_id` = '$brandId' , `category_id` = '$categoryId' , quantity = '$quantity', images = '$Newimages', orignal_price ='$orignalPrice', discounted_price = '$discountedPrice', status = '$status', colors = '$colors', sizes = '$sizes', `show` = '$show' , promotion = '$promotion', description = '$description', specification = '$specification' WHERE id = {$_GET['id']}";
        if ($conn->query($sqlAddProduct) == TRUE) {
            echo "<script> window.location.href = 'products.php';</script>";
        }
    } else {

        $sqlAddProduct = "UPDATE products SET name = '$prodName', `brand_id` = '$brandId' , `category_id` = '$categoryId' , quantity = '$quantity', orignal_price ='$orignalPrice', discounted_price = '$discountedPrice', status = '$status', colors = '$colors', sizes = '$sizes', `show` = '$show' , promotion = '$promotion', description = '$description', specification = '$specification' WHERE id = {$_GET['id']}";
        if ($conn->query($sqlAddProduct) == TRUE) {
            echo "<script> window.location.href = 'products.php';</script>";
        }
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
                                    <u>Update Product</u>
                                </p>

                                <div class="pb-2">
                                    <div class="card">
                                        <div class="card-body">
                                            <form action="update_product.php?id=<?php echo $_GET['id']; ?>" method="post" enctype="multipart/form-data">
                                                <div class="align-items-center">
                                                    <input type="text" class="form-control form-control-lg" style="border: 1px solid black;"
                                                        id="name" placeholder=" Name..." name="name" value="<?php echo $oldResults['name'] ?>">
                                                    <div class="d-flex flex-row align-items-center my-2">
                                                        <input type="number" class="form-control form-control-lg mx-2" style="border: 1px solid black;"
                                                            id="quantity" placeholder="Quantity" name="quantity" value="<?php echo $oldResults['quantity'] ?>" required>
                                                        <input type="file" class="form-control form-control-lg mx-2"
                                                            id="image" name="image[]" accept=".png,.jpg,.jpeg" multiple> <br>
                                                    </div>
                                                    <div class="d-flex" style="flex-wrap: wrap; justify-content:space-evenly;">
                                                        <?php for ($x = 0; $x < count($oldImages); $x++) {

                                                            echo "<div style = 'display: flex; flex-direction: column;'><img src = $oldImages[$x] style = 'width:150px;'><a href='delete_image.php?src=$oldImages[$x]&&id={$_GET['id']}'>Delete</a></div>";
                                                        } ?>
                                                    </div>
                                                    <div class="d-flex flex-row align-items-center my-2">
                                                        <input type="number" class="form-control form-control-lg mx-2" style="border: 1px solid black;"
                                                            id="quantity" placeholder="Orignal Price" name="orignalPrice" value="<?php echo $oldResults['orignal_price'] ?>" required>
                                                        <input type="number" class="form-control form-control-lg mx-2" style="border: 1px solid black;"
                                                            id="quantity" placeholder="Discounted Price" name="discountedPrice" value="<?php echo $oldResults['discounted_price'] ?>" required>
                                                    </div>
                                                    <select name="status" id="status" class="form-control form-control-lg mx-2 mr-4">
                                                        <option value="Allow" <?php if ($oldResults['status'] == 'Allow') echo 'selected' ?>>Allow</option>
                                                        <option value="Block" <?php if ($oldResults['status'] == 'Block') echo 'selected' ?>>Block</option>
                                                    </select>
                                                    <select name="show" id="show" class="form-control form-control-lg mx-2 mr-4">
                                                        <option value="None" <?php if ($oldResults['show'] == 'None') echo 'selected' ?>>None</option>
                                                        <option value="New" <?php if ($oldResults['show'] == 'New') echo 'selected' ?>>New</option>
                                                        <option value="Featured" <?php if ($oldResults['show'] == 'Featured') echo 'selected' ?>>Featured</option>
                                                        <option value="Hot" <?php if ($oldResults['show'] == 'Hot') echo 'selected' ?>>Hot</option>
                                                        <option value="Best" <?php if ($oldResults['show'] == 'Best') echo 'selected' ?>>Best Seller</option>
                                                    </select>
                                                    <select name="brand" id="brand" class="form-control form-control-lg mx-2 mr-4">
                                                        <option value="">Select Brand</option>
                                                        <?php
                                                        $sql_add_brand = "SELECT * FROM brands WHERE `status` = 'Allow'";
                                                        $sql_add_brand_Result = $conn->query($sql_add_brand);
                                                        $brands = [];
                                                        while ($row = $sql_add_brand_Result->fetch_assoc()) {
                                                            $selected = ($row['id'] == $oldResults['brand_id']) ? 'selected' : '';
                                                            echo "<option value='{$row['id']}' {$selected}>{$row['name']}</option>";
                                                        }
                                                        ?>
                                                    </select>

                                                    <select name="category" id="category" class="form-control form-control-lg mx-2 mr-4">
                                                        <option value="">Select Category</option>
                                                        <?php
                                                        $sql_add_category = "SELECT * FROM `categories` WHERE `status_of` = 'Allow'";
                                                        $sql_add_category_Result = $conn->query($sql_add_category);
                                                        $categories = [];
                                                        while ($row = $sql_add_category_Result->fetch_assoc()) {
                                                            $selected = ($row['id'] == $oldResults['category_id']) ? 'selected' : '';
                                                            echo "<option value='{$row['id']}' {$selected}>{$row['name']}</option>";
                                                        }
                                                        ?>
                                                    </select>

                                                    <h3 class="mx-3 my-2" style="color: gray;">Select Colors:</h3>
                                                    <div class="d-flex flex-row align-items-center my-2 mx-2">

                                                        <input type="checkbox" class=" mx-2" style="border: 1px solid black;"
                                                            id="quantity" placeholder="Quantity" name="colorBlack" value="Black" <?php if ($oldColors['colorBlack'] == TRUE) echo "checked" ?>> <label for="Black">Black</label>
                                                        <input type="checkbox" class=" mx-2" style="border: 1px solid black;"
                                                            id="quantity" placeholder="Quantity" name="colorBlue" value="Blue" <?php if ($oldColors['colorBlue'] == TRUE) echo "checked" ?>> <label for="Blue">Blue</label>
                                                        <input type="checkbox" class=" mx-2" style="border: 1px solid black;"
                                                            id="quantity" placeholder="Quantity" name="colorGreen" value="Green" <?php if ($oldColors['colorGreen'] == TRUE) echo "checked" ?>> <label for="Green">Green</label>
                                                        <input type="checkbox" class=" mx-2" style="border: 1px solid black;"
                                                            id="quantity" placeholder="Quantity" name="colorRed" value="Red" <?php if ($oldColors['colorRed'] == TRUE) echo "checked" ?>> <label for="Red">Red</label>
                                                        <input type="checkbox" class=" mx-2" style="border: 1px solid black;"
                                                            id="quantity" placeholder="Quantity" name="colorYellow" value="Yellow" <?php if ($oldColors['colorYellow'] == TRUE) echo "checked" ?>> <label for="Yellow">Yellow</label>
                                                        <input type="checkbox" class=" mx-2" style="border: 1px solid black;"
                                                            id="quantity" placeholder="Quantity" name="colorBrown" value="Brown" <?php if ($oldColors['colorBrown'] == TRUE) echo "checked" ?>> <label for="Brown">Brown</label>
                                                    </div>
                                                    <h3 class="mx-3 my-2" style="color: gray;">Select Size:</h3>
                                                    <div class="d-flex flex-row align-items-center my-2 mx-2">

                                                        <input type="checkbox" class=" mx-2" style="border: 1px solid black;"
                                                            id="quantity" placeholder="Quantity" name="sizeXS" value="XS" <?php if ($oldSizes['XS'] == TRUE) echo "checked" ?>> <label for="XS">XS</label>
                                                        <input type="checkbox" class=" mx-2" style="border: 1px solid black;"
                                                            id="quantity" placeholder="Quantity" name="sizeS" value="S" <?php if ($oldSizes['S'] == TRUE) echo "checked" ?>> <label for="S">S</label>
                                                        <input type="checkbox" class=" mx-2" style="border: 1px solid black;"
                                                            id="quantity" placeholder="Quantity" name="sizeM" value="M" <?php if ($oldSizes['M'] == TRUE) echo "checked" ?>> <label for="M">M</label>
                                                        <input type="checkbox" class=" mx-2" style="border: 1px solid black;"
                                                            id="quantity" placeholder="Quantity" name="sizeL" value="L" <?php if ($oldSizes['L'] == TRUE) echo "checked" ?>> <label for="L">L</label>
                                                        <input type="checkbox" class=" mx-2" style="border: 1px solid black;"
                                                            id="quantity" placeholder="Quantity" name="sizeXL" value="XL" <?php if ($oldSizes['XL'] == TRUE) echo "checked" ?>> <label for="XL">XL</label>
                                                        <input type="checkbox" class=" mx-2" style="border: 1px solid black;"
                                                            id="quantity" placeholder="Quantity" name="sizeXXL" value="XXL" <?php if ($oldSizes['XXL'] == TRUE) echo "checked" ?>> <label for="XXL">XXL</label>
                                                    </div>
                                                    <h4 class="mx-3 my-2" style="color: gray;">Add Promotion (if any):</h4>
                                                    <div class=" align-items-center my-2">
                                                        <div class="d-flex flex-row align-items-center my-2"> <input type="number" class="form-control form-control-lg mx-2" style="border: 1px solid black;"
                                                                id="quantity" placeholder="Discount Percentage" name="promotionPercentage" value="<?php echo $oldPromotion['promotionPercentage']; ?>"><label for="%">%</label></div>
                                                        <input type="text" class="form-control form-control-lg mx-2"
                                                            id="image" name="promotionName" placeholder="Promotion Name.." style="border: 1px solid black;" value="<?php echo $oldPromotion['promotionName']; ?>"> <br>
                                                    </div>

                                                </div><br>
                                                <textarea required name="description" id="description" cols="30" class="my-2 form-control form-control-lg mx-2" rows="5" placeholder="Write Product Description Here" style="border: 1px solid black;"><?php echo $oldResults['description']; ?></textarea>
                                                <textarea required name="specification" id="specification" cols="30" class="my-2 form-control form-control-lg mx-2" rows="5" placeholder="Write Product specification Here" style="border: 1px solid black;"><?php echo $oldResults['specification']; ?></textarea>

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