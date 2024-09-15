<?php
if ($_SESSION['acc_type'] != "Retailer") {
    session_destroy();
    header("Location: ../register_login.php");
}
