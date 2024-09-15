<?php
require_once('../Model/db.php');
session_start();

require_once('../auth/check_auth.php');
require_once('../auth/check_dealer.php');

$dealerId = $_SESSION['user_id'];
$sql = "SELECT * FROM requested_price WHERE dealer_id = '$dealerId' AND status=0";

$result = mysqli_query($conn, $sql);


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
            <h1>Requested Price</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="./index.php">Home</a></li>
                    <li class="breadcrumb-item active">Requested Price</li>
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
                                        <th scope="col">Retailer Name</th>
                                        <th scope="col">Shop</th>
                                        <th scope="col">Location</th>
                                        <th scope="col">Photo</th>
                                        <th scope="col">Contact No</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = mysqli_fetch_assoc($result)) {
                                        $retailerSql = "SELECT * FROM user WHERE id = {$row['retailer_id']}";
                                        $retailerResult = mysqli_query($conn, $retailerSql);
                                        $retailerRow = mysqli_fetch_array($retailerResult, MYSQLI_ASSOC);
                                    ?>
                                        <tr>
                                            <td><?= $retailerRow['f_name']; ?> <?= $retailerRow['l_name']; ?></td>
                                            <td><?= $retailerRow['store_name']; ?></td>
                                            <td><?= $retailerRow['address']; ?></td>
                                            <td><img src="../public/media/profileImage/<?= $retailerRow['image'] ?>" style="width:200px; height:100px;"></td>
                                            <td><?= $retailerRow['phone_no']; ?></td>
                                            <td><?= $retailerRow['created_at']; ?></td>
                                            <td>
                                                <a href="approved_price.php?product_id=<?= $row['id'] ?>"><button class="btn btn-sm btn-success">Approved</button></a>
                                                <a href="decline_price.php?product_id=<?= $row['id'] ?>"><button class="btn btn-sm btn-danger">Decline</button></a>
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