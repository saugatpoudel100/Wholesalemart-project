<?php
error_reporting(0);
require_once('../Model/db.php');
session_start();

require_once('../auth/check_auth.php');
require_once('../auth/check_retailer.php');
if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    $sql = "SELECT * FROM product WHERE id = $product_id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    if ($count == 0) {
        echo "No product found.";
    } else {
        $requested_sql =
            "SELECT * FROM requested_price WHERE retailer_id = " . $_SESSION['user_id'] . " AND dealer_id = " . $row['dealer_id'];
        $requested_result = mysqli_query($conn, $requested_sql);
        $requested_row = mysqli_fetch_array($requested_result, MYSQLI_ASSOC);
?>

        <!DOCTYPE html>
        <html lang="en">

        <?php include '../component/retailer/head.php'; ?>

        <body>
            <!-- ======= Header ======= -->
            <?php include '../component/retailer/header.php'; ?>
            <!-- End Header -->

            <!-- ======= Sidebar ======= -->
            <?php include '../component/retailer/sidebar.php'; ?>
            <!-- End Sidebar-->

            <main id="main" class="main">
                <div class="pagetitle">
                    <h1>Product Detail</h1>
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="./index.php">Home</a></li>
                            <li class="breadcrumb-item"><a href="./product_list.php">Product</a></li>
                            <li class="breadcrumb-item active">Product Detail</li>
                        </ol>
                    </nav>
                </div>
                <section class="section">
                    <div class="row align-items-top">
                        <div class="col-lg-12">
                            <div class="card" style="min-height:500px;">
                                <div class="row g-0">
                                    <div class="col-md-4">
                                        <img src="../public/media/productImage/<?= $row['product_image']; ?>" class="img-fluid rounded-start" style="width:100%; height:400px;" alt="...">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <h5 class="card-title"><?= $row['product_name']; ?></h5>
                                            <p class="card-text"><?= $row['product_description']; ?></p>
                                            <div class="row">
                                                <div class="col">
                                                    <h4><span><?php if ($row['stock'] == 0) {
                                                                    echo "<span class='badge bg-danger'>Out of stock</span>";
                                                                } else if ($row['stock'] <= 2) {
                                                                    echo "<span class='badge bg-danger'>In Stock : " . $row['stock'] . "</span>";
                                                                } else {
                                                                    echo "<span class='badge bg-success'>In Stock :" . $row['stock'] . "</span>";
                                                                } ?>
                                                        </span></h4>
                                                </div>
                                                <div class="col float-right">
                                                    <?php
                                                    if (isset($requested_row['status'])) {
                                                        if ($requested_row['status'] == 1) { ?>
                                                            <h4>
                                                                <span class="badge bg-success">
                                                                    Price: <?= $row['price']; ?>
                                                                </span>
                                                            </h4>
                                                        <?php } else if ($requested_row['status'] == 0) { ?>
                                                            <a href="product_detail.php?product_id=<?= $row['id']; ?>" class="btn btn-warning float-left">Already Requested</a>
                                                        <?php } else if ($requested_row['status'] == -1) { ?><a href="product_detail.php?product_id=<?= $row['id']; ?> " class="btn btn-danger float-left">Declined</a> <?php }
                                                                                                                                                                                                                } else { ?><a href="request_price.php?dealer_id=<?= $row['dealer_id']; ?>&product_id=<?= $row['id']; ?>" class="btn btn-primary float-left">Request Price</a>
                                                    <?php } ?>
                                                    <?php if ($requested_row['status'] == 1) {
                                                        if ($row['stock'] > 0) {
                                                    ?>
                                                            <form method='post' action='add_cart.php'>
                                                                <input type='hidden' name='product_id' value="<?php echo $row['id']; ?>">
                                                                <label>Quantity:</label> <input class="p-1 mt-5 " type='number' name='quantity' value='1' min='1'>
                                                                <input class="btn btn-primary bg-success" type='submit' value='Add to Cart'>
                                                            </form>
                                                    <?php }
                                                    } ?>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    </div>
                </section>

            </main>
            <!-- End #main -->

            <!-- ======= Footer ======= -->
            <?php include '../component/retailer/footer.php'; ?>
        </body>

        </html>
<?php }
} else {
    echo "Dealer ID not provided.";
}
?>