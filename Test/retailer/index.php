<?php
require_once('../Model/db.php');
session_start();

require_once('../auth/check_auth.php');
require_once('../auth/check_retailer.php');

$retailer_id = $_SESSION['user_id'];

$sql_purchase = "SELECT * FROM orders WHERE user_id ='$retailer_id' AND status = 'Delivered'";
$purchase_result = mysqli_query($conn, $sql_purchase);
$total_purchase = mysqli_num_rows($purchase_result);


$currentYear = date("Y-m-d");
$sql_annual_purchase = "SELECT SUM(total_amount) AS total_purchase 
                       FROM orders 
                       WHERE user_id = '$retailer_id' 
                       AND status = 'Delivered' 
                       AND YEAR(order_date) = '$currentYear'";

$annual_purchase_result = mysqli_query($conn, $sql_annual_purchase);
$total_annual_purchase = mysqli_fetch_assoc($annual_purchase_result);
$annual_purchase = $total_annual_purchase['total_purchase'];

$sql_customer = "SELECT * FROM requested_price WHERE retailer_id = '$retailer_id' AND status = 1";
$customer_result = mysqli_query($conn, $sql_customer);
$total_customer = mysqli_num_rows($customer_result);

$order_query = "SELECT * FROM orders WHERE user_id ='$retailer_id'";
$order_result = mysqli_query($conn, $order_query);
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
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="./index.php">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
        </div>
        <!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">
                <!-- Left side columns -->
                <div class="col-lg-12">
                    <div class="row">
                        <!-- Sales Card -->
                        <div class="col-xxl-4 col-md-6">
                            <div class="card info-card sales-card">

                                <div class="card-body">
                                    <h3 class="card-title">Purchases</h3>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-cart"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6 class="count" data-count="<?= $total_purchase; ?>">
                                                <?= $total_purchase; ?>
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Sales Card -->

                        <!-- Revenue Card -->
                        <div class="col-xxl-4 col-md-6">
                            <div class="card info-card revenue-card">
                                <div class="filter">

                                    <input type="date" id="filter-year" name="filter-year">
                                    <button id="filter-button"
                                        class="btn btn-sm btn-success float-right">Filter</button>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">
                                        Annual
                                    </h5>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-currency-dollar"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6 id="annual-purchase-container">
                                                <?= intval($annual_purchase); ?>
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Revenue Card -->

                        <!-- Customers Card -->
                        <div class="col-xxl-4 col-xl-12">
                            <div class="card info-card customers-card">

                                <div class="card-body">
                                    <h5 class="card-title">
                                        Approved Dealers
                                    </h5>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-people"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6 class="count" data-count="<?= $total_customer; ?>">
                                                <?= $total_customer; ?>
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Customers Card -->

                        <!-- Reports -->
                        <div class="col-12">
                            <div class="card">
                                <div class="filter">
                                    <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                            class="bi bi-three-dots"></i></a>
                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                        <li class="dropdown-header text-start">
                                            <h6>Filter</h6>
                                        </li>

                                        <li><a class="dropdown-item" href="#">Today</a></li>
                                        <li><a class="dropdown-item" href="#">This Month</a></li>
                                        <li><a class="dropdown-item" href="#">This Year</a></li>
                                    </ul>
                                </div>


                                <!-- Recent Sales -->
                                <div class="col-12">
                                    <div class="card recent-sales overflow-auto">
                                        <div class="filter">
                                            <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                                    class="bi bi-three-dots"></i></a>
                                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                                <li class="dropdown-header text-start">
                                                    <h6>Filter</h6>
                                                </li>

                                                <li><a class="dropdown-item" href="#">Today</a></li>
                                                <li><a class="dropdown-item" href="#">This Month</a></li>
                                                <li><a class="dropdown-item" href="#">This Year</a></li>
                                            </ul>
                                        </div>

                                        <div class="card-body">
                                            <h5 class="card-title">
                                                All Orders
                                            </h5>

                                            <table class="table table-border datatable">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Order Id</th>
                                                        <th scope="col">Order Date</th>
                                                        <th scope="col">Full Name</th>
                                                        <th scope="col">Address</th>
                                                        <th scope="col">Payment Method</th>
                                                        <th scope="col">Note</th>
                                                        <th scope="col">Status</th>
                                                        <th scope="col">Total Amount</th>
                                                        <th scope="col">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php while ($row = mysqli_fetch_assoc($order_result)) { ?>
                                                        <tr>
                                                            <td>
                                                                <?= $row['order_id']; ?>
                                                            </td>
                                                            <td>
                                                                <?= $row['order_date'] ?>
                                                            </td>
                                                            <td>
                                                                <?= $row['full_name']; ?>
                                                            </td>
                                                            <td>
                                                                <?= $row['address']; ?>
                                                            </td>
                                                            <td>
                                                                <?= $row['payment_method']; ?>
                                                            </td>
                                                            <td>
                                                                <?= $row['note']; ?>
                                                            </td>
                                                            <td>
                                                                <span
                                                                    class="badge bg-<?php if ($row['status'] == 'Delivered') { ?>success<?php }
                                                                    if ($row['status'] == 'Pending') { ?>warning<?php }
                                                                    if ($row['status'] == 'Cancelled') { ?>danger<?php } ?>">
                                                                    <?= $row['status']; ?>
                                                                </span>
                                                            </td>
                                                            <td>
                                                                <?= $row['total_amount']; ?>
                                                            </td>
                                                            <td>
                                                                <a
                                                                    href="./view_order.php?id=<?= $row['order_id'] ?>&confirm=yes">View
                                                                    Order</a>
                                                            </td>


                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
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
    <script>
        const myNum = document.querySelectorAll('.count')
        let speed = 100;

        myNum.forEach((myCount) => {


            let target_count = myCount.dataset.count;
            let init_count = +myCount.innerText;
            // console.log(target_count)

            let new_increment_num = Math.floor(target_count / speed);

            const updateNumber = () => {
                init_count += new_increment_num;
                myCount.innerText = init_count;

                if (init_count < target_count) {
                    setTimeout(() => {
                        updateNumber()
                    }, 5)
                }
            }

            updateNumber();

        })
    </script>

    <?php include '../component/retailer/footer.php'; ?>
    <script>
        document.getElementById('filter-button').addEventListener('click', function () {
            if (document.getElementById('filter-year').value == '') {
                alert('Please select a year');
                return;
            }
            const selectedYear = document.getElementById('filter-year').value;
            const retailer_id = <?= $retailer_id ?>;
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'get_annual_purchase.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    const annualPurchases = xhr.responseText;
                    document.getElementById('annual-purchase-container').innerHTML = `${annualPurchases}`;
                }
            };
            xhr.send(`retailer_id=${retailer_id}&year=${selectedYear}`);
        });
    </script>
</body>

</html>