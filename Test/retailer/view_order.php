<?php
require_once('../Model/db.php');
session_start();

require_once('../auth/check_auth.php');
require_once('../auth/check_retailer.php');

$query = "SELECT * FROM order_items WHERE order_id = '" . $_GET['id'] . "'";
$result = mysqli_query($conn, $query);

$total_price = 0;

?>
<!DOCTYPE html>
<html lang="en">

<?php include '../component/retailer/head.php'; ?>

<body>

    <?php include '../component/retailer/header.php'; ?>
    <?php include '../component/retailer/sidebar.php'; ?>
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>My Cart</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="./order_history.php">Order History</a></li>
                    <li class="breadcrumb-item active">View Order</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Image</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = mysqli_fetch_assoc($result)) {
                                        $product_sql = "SELECT * FROM product WHERE id = " . $row['product_id'];
                                        $product_result = mysqli_query($conn, $product_sql);
                                        $product_row = mysqli_fetch_array($product_result, MYSQLI_ASSOC);
                                        $total_price += $row['quantity'] * $row['price'];
                                    ?>

                                        <tr>
                                            <td><img src="../public/media/productImage/<?= $product_row['product_image'] ?>" style="width:200px;height:150px;"></td>
                                            <td><?= $product_row['product_name'] ?></td>
                                            <td><?= $row['quantity'] ?></td>
                                            <td><?= $row['price'] ?></td>
                                        </tr>

                                    <?php } ?>

                                    <tr>
                                        <td colspan="6">
                                            <span style="float:right"><b>Total Price: <?= $total_price ?></b> </span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>

                </div>
            </div>
        </section>
    </main>
    <?php include '../component/retailer/footer.php'; ?>

</body>

</html>
<?php
mysqli_close($conn);
?>