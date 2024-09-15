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
            <h1>Checkout</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="./index.php">Home</a></li>
                    <li class="breadcrumb-item active">Checkout</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <form method="post" action="checkout-process.php" enctype="multipart/form-data"
                                class="row g-3">
                                <div class="col-md-6">
                                    <label for="fname_id" class="form-label">First Name</label>
                                    <input type="text" class="form-control" name="fname" id="fname_id" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="lname_id" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" name="lname" id="lname_id">
                                </div>
                                <div class="col-md-6">
                                    <label for="address_id" class="form-label">Address</label>
                                    <input type="text" class="form-control" name="address" id="address_id">
                                </div>
                                <div class="col-md-6">
                                    <label for="payment_id" class="form-label">Payment Method</label>
                                    <select class="form-select" name="payment_method">
                                        <option value="cash">Cash</option>
                                        <option value="khalti">Khalti</option>
                                    </select>
                                </div>
                                <div class="col-md-12">
                                    <label for="note_id" class="form-label">Note</label>
                                    <input type="text" class="form-control" name="note" id="note_id">
                                </div>

                                <button class="btn btn-primary update-btn" type="submit">Checkout</button>
                            </form>
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