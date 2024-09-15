<?php
if ($_SESSION['acc_type'] != "Dealer") {
    session_destroy();
    header("Location: ../register_login.php");
}
