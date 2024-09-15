<?php
require_once('../Model/db.php');
session_start();

require_once('../auth/check_auth.php');
require_once('../auth/check_dealer.php');

$successMessage = "";
$errorMessage = "";
$sql = "SELECT * FROM product WHERE id = " . $_GET['product_id'];
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dealerId = $_SESSION['user_id'];
    $product_id = $_GET['product_id'];

    $productName = $_POST['product_name'];
    $productDescription = mysqli_real_escape_string($conn, $_POST['product_description']);
    $stock = mysqli_real_escape_string($conn, $_POST['stock']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    if ($_FILES['product_image']['name'] != "") {
        $imageFileName = $_FILES['product_image']['name'];
        $imageTmpName = $_FILES['product_image']['tmp_name'];
        $imageFileType = strtolower(pathinfo($imageFileName, PATHINFO_EXTENSION));

        if (getimagesize($imageTmpName)) {
            $uniqueImageName = uniqid() . '.' . $imageFileType;

            $uploadDirectory = "../public/media/productImage/";
            move_uploaded_file($imageTmpName, $uploadDirectory . $uniqueImageName);

            $productImage = $uniqueImageName;
        } else {
            $errorMessage = "Invalid image file. Please upload a valid image.";
        }
    } else {
        $productImage = $row['product_image'];
    }

    $insertQuery = "UPDATE product SET product_name = '$productName', product_description = '$productDescription', stock = $stock, product_image = '$productImage', price = '$price', dealer_id = '$dealerId' WHERE id = '$product_id' AND dealer_id = '$dealerId'";

    if (mysqli_query($conn, $insertQuery)) {
        $successMessage = "Product updated successfully.";
        header("Location: ./product_list.php");
    } else {
        $errorMessage = "Error inserting product: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<?php include '../component/dealer/head.php'; ?>

<body>
    <?php include '../component/dealer/header.php'; ?>
    <?php include '../component/dealer/sidebar.php'; ?>
    <!-- End Sidebar-->

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Product</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="./index.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="./product_list.php">Product</a></li>
                    <li class="breadcrumb-item active">Edit Product</li>
                </ol>
            </nav>
        </div>
        <!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Add Product</h5>
                            <?php
                            if ($successMessage) {
                                echo "<p>$successMessage</p>";
                            }

                            if ($errorMessage) {
                                echo "<p>$errorMessage</p>";
                            }
                            ?>
                            <form method="post" action="" enctype="multipart/form-data" class="row g-3">
                                <div class="col-md-6">
                                    <label for="product_name_id" class="form-label">Product Name</label>
                                    <input type="text" class="form-control" name="product_name" id="product_name_id" value="<?= $row['product_name'] ?>" required>
                                </div>
                                <div class=" col-md-6">
                                    <label for="product_image_id" class="form-label">Image</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="file" name="product_image" id="product_image_id">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="product_description_id" class="form-label">Description</label>
                                    <textarea type="text" class="form-control" id="product_description_id" name="product_description" rows=" 5"><?= $row['product_description']; ?></textarea>
                                </div>
                                <div class="col-md-6">
                                    <label for="price_id" class="form-label">Price</label>
                                    <input type="number" class="form-control" name="price" id="price_id" value="<?= $row['price'] ?>">
                                </div>
                                <div class="col-md-6">
                                    <label for="stock_id" class="form-label">Stock</label>
                                    <input type="number" class="form-control" name="stock" id="stock_id" value="<?= $row['stock'] ?>">
                                </div>

                                <button class="btn btn-primary update-btn" type="submit">Update Product</button>
                            </form><!-- End Multi Columns Form -->

                        </div>
                    </div>

                </div>
            </div>
        </section>
    </main>

    <?php include '../component/dealer/footer.php'; ?>
</body>

</html>
<?php
mysqli_close($conn);
?>