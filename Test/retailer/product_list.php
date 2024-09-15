<?php
error_reporting(0);
require_once('../Model/db.php');
session_start();

require_once('../auth/check_auth.php');
require_once('../auth/check_retailer.php');

$query = "SELECT * FROM product";
$result = mysqli_query($conn, $query);
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
            <h1>Product List</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="./index.php">Home</a></li>
                    <li class="breadcrumb-item active">Product List</li>
                </ol>
            </nav>
        </div>
        <section class="section">
            <div class="row align-items-top">
                <?php while ($row = mysqli_fetch_assoc($result)) {
                    $requested_sql =
                        "SELECT * FROM requested_price WHERE retailer_id = " . $_SESSION['user_id'] . " AND dealer_id = " . $row['dealer_id'];
                    $requested_result = mysqli_query($conn, $requested_sql);
                    $requested_row = mysqli_fetch_array($requested_result, MYSQLI_ASSOC);

                ?>
                    <div class="col-lg-3">
                        <a>
                            <div class="card">
                                <a href="product_detail.php?product_id=<?= $row['id']; ?>">
                                    <img src=" ../public/media/productImage/<?= $row['product_image']; ?>" style="width:100%; height:200px;">
                                </a>
                                <div class="card-body">
                                    <h5 class="card-title"><?= $row['product_name'];  ?> </h5>
                                    <p class="card-text"><?php echo substr($row['product_description'], 0, 150) ?><?php if (strlen($row['product_description']) > 150) {
                                                                                                                        echo "...";
                                                                                                                    } ?> </p>
                                    <p class="card-text">
                                    <h5><?php if ($row['stock'] == 0) {
                                            echo "<span class='badge bg-danger'>Out of stock</span>";
                                        } else if ($row['stock'] <= 2) {
                                            echo "<span class='badge bg-danger'>In Stock : " . $row['stock'] . "</span>";
                                        } else {
                                            echo "<span class='badge bg-success'>In Stock :" . $row['stock'] . "</span>";
                                        } ?>

                                        <?php
                                        if (isset($requested_row['status'])) {

                                            if ($requested_row['status'] == 1) { ?>
                                                <a href="product_detail.php?product_id=<?= $row['id']; ?> " class="btn btn-success offset-2">View Product</a>
                                            <?php } else if ($requested_row['status'] == 0) { ?><a href="product_detail.php?product_id=<?= $row['id']; ?>" class="btn btn-warning float-left offset-1 ">Already Requested</a>
                                            <?php } else if ($requested_row['status'] == -1) { ?><a href="product_detail.php?product_id=<?= $row['id']; ?> " class="btn btn-danger float-left offset-2">Declined</a> <?php }
                                                                                                                                                                                                                } else { ?><a href="request_price.php?dealer_id=<?= $row['dealer_id']; ?>&product_id=<?= $row['id']; ?>" class="btn btn-primary float-left">Request Price</a>
                                        <?php } ?>
                                    </h5>
                                    </p>

                                </div>
                            </div>
                    </div>
                <?php } ?>

            </div>
        </section>
    </main>
    <?php include '../component/retailer/footer.php'; ?>
</body>

</html>