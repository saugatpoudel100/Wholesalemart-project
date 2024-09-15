<?php
require_once('../Model/db.php');
session_start();

require_once('../auth/check_auth.php');
require_once('../auth/check_dealer.php');

$query = "SELECT * FROM product WHERE dealer_id = " . $_SESSION['user_id'] . " ORDER BY created DESC";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="en">

<?php include '../component/dealer/head.php'; ?>

<body>
    <!-- ======= Header ======= -->
    <?php include '../component/dealer/header.php'; ?>
    <!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <?php include '../component/dealer/sidebar.php'; ?>
    <!-- End Sidebar-->

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Product List</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="./index.php">Home</a></li>
                    <li class="breadcrumb-item">Product</li>
                    <li class="breadcrumb-item active">Product List</li>
                </ol>
            </nav>
        </div>
        <!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Product Image</th>
                                        <th scope="col">Stock</th>
                                        <th scope="col">Product Created</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                        <tr>
                                            <td><?= $row['product_name']; ?></td>
                                            <td><?php echo substr($row['product_description'], 0, 150) ?><?php if (strlen($row['product_description']) > 150) {
                                                                                                                echo "...";
                                                                                                            } ?> </td>
                                            <td><?= $row['price']; ?></td>
                                            <td><img src="../public/media/productImage/<?= $row['product_image']; ?>" style="width:200px; height:100px;"></td>
                                            <td><span class="status <?php if ($row['stock'] <= 2) {
                                                                        echo "return";
                                                                    } else {
                                                                        echo "delivered";
                                                                    } ?>"><?php if ($row['stock'] == 0) {
                                                                                echo "Out of Stock";
                                                                            } else {
                                                                                echo $row['stock'];
                                                                            } ?></span></td>
                                            <td><?= $row['created']; ?></td>
                                            <td>
                                                <a href="edit_product.php?product_id=<?= $row['id']; ?>">
                                                    <button class="btn btn-sm btn-success">Edit</button>
                                                </a>
                                                <a href="delete_product.php?product_id=<?= $row['id']; ?>">
                                                    <button class="btn btn-sm btn-danger">Delete</button>
                                                </a>
                                            </td>

                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <!-- End Table with stripped rows -->

                        </div>
                    </div>

                </div>
            </div>
        </section>
    </main>
    <!-- End #main -->

    <!-- ======= Footer ======= -->
    <?php include '../component/dealer/footer.php'; ?>
</body>

</html>
<?php
mysqli_close($conn);
?>