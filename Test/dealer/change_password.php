<?php
require_once('../Model/db.php');
session_start();

require_once('../auth/check_auth.php');
require_once('../auth/check_dealer.php');
if (isset($_GET['error'])) {
    $errorMessage = $_GET['error'];
}
$sql = "SELECT * FROM user WHERE id = '" . $_SESSION['user_id'] . "'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
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
            <h1>Profile</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="./index.php">Home</a></li>
                    <li class="breadcrumb-item active">Change Password</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section profile">
            <div class="row">
                <div class="col-xl-4">

                    <div class="card">
                        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                            <img src="../public/media/profileImage/<?= $_SESSION['profile_pic']; ?>" alt="Profile" class="rounded-circle">
                            <h2><?= $row['f_name']; ?> <?= $row['l_name']; ?></h2>
                            <h3><b><?= $row['store_name'] ?></b></h3>
                            <h3><?= $row['acc_type']; ?></h3>
                            <div class="social-links mt-2">
                                <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                                <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-xl-8">

                    <div class="card">
                        <div class="card-body pt-3">

                            <ul class="nav nav-tabs nav-bordered mb-3 ">
                                <li class="nav-item">
                                    <h5><b>Change Password</b></h5>
                                </li>
                            </ul>
                            <form action="./password_controller.php" method="post" onsubmit=" return passCheck()">

                                <div class="row mb-3">
                                    <label for="password" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="password" type="password" class="form-control" id="password" required>
                                        <?php if (isset($errorMessage)) { ?>
                                            <p style="color: red;"><?php echo $errorMessage; ?></p>
                                        <?php } ?>

                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="new_password" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="new_password" type="password" class="form-control" id="new_Password" required>
                                        <span id="message" style="color: red;"></span>
                                    </div>
                                </div>

                                <div class="row mb-3">

                                    <label for="confirmPassword" class="col-md-4 col-lg-3 col-form-label">Confirm New Password</label>
                                    <div class="col-md-8 col-lg-9">

                                        <input name="confirmPassword" type="password" class="form-control" id="renewPassword" required>
                                    </div>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Change Password</button>
                                </div>
                            </form><!-- End Change Password Form -->

                        </div>
                        </ul>

                    </div><!-- End Bordered Tabs -->

                </div>
            </div>
            </div>


        </section>

    </main><!-- End #main -->
    <script>
        function passCheck() {
            var newpassword = document.getElementById("new_Password").value;
            var confirmPassword = document.getElementById("renewPassword").value;
            if (newpassword != confirmPassword) {
                document.getElementById("message").innerHTML = "Passwords do not match.";
                return false;
            } else {
                return true;
            }
        }
    </script>

    <!-- ======= Footer ======= -->
    <?php include '../component/dealer/footer.php'; ?>
</body>

</html>