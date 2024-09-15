<?php
require_once('../Model/db.php');
session_start();

require_once('../auth/check_auth.php');
require_once('../auth/check_retailer.php');

$query = "SELECT * FROM cart_items WHERE user_id = " . $_SESSION['user_id'] . " ORDER BY created DESC";
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
                    <li class="breadcrumb-item"><a href="./index.php">Home</a></li>
                    <li class="breadcrumb-item active">My Cart</li>
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
                                        <th scope="col">Stock</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = mysqli_fetch_assoc($result)) {
                                        $product_sql = "SELECT * FROM product WHERE id = " . $row['product_id'];
                                        $product_result = mysqli_query($conn, $product_sql);
                                        $product_row = mysqli_fetch_array($product_result, MYSQLI_ASSOC);
                                        $total_price += $row['quantity'] * $product_row['price'];
                                    ?>

                                        <tr>
                                            <td><img src="../public/media/productImage/<?= $product_row['product_image'] ?>" style="width:200px;height:150px;"></td>
                                            <td><?= $product_row['product_name'] ?></td>
                                            <td>
                                                <?php if ($product_row['stock'] > 0) {
                                                ?>
                                                    <form method='post' action='add_cart.php'>
                                                        <input type='hidden' name='product_id' value="<?php echo $product_row['id']; ?>">
                                                        <input class="p-1 mt-0" type='number' name='quantity' value="<?= $row['quantity'] ?>" min='1'>
                                                        <input class="btn btn-primary bg-primary" type='submit' name="update" value='Update'>
                                                    </form>
                                                <?php
                                                } ?>
                                            </td>
                                            <td><?= $product_row['stock'] ?></td>
                                            <td><?= $row['quantity'] * $product_row['price'] ?></td>
                                            <td>
                                                <a href="remove_cart_product.php?product_id=<?= $product_row['id'] ?>" class="btn btn-danger">Delete</a>

                                            </td>
                                        </tr>

                                    <?php } ?>

                                    <?php if (mysqli_num_rows($result) > 0) { ?>
                                        <tr>
                                            <td colspan="6">
                                                <span style="float:right"><b>Total Price: <?= $total_price ?></b> </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="6">
                                                <a href="clear_cart.php" class="btn btn-danger">Clear Cart</a>

                                                <a style="float:right" href="checkout.php" class="btn btn-success">Checkout</a>
                                            </td>
                                        </tr>
                                    <?php } ?>
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