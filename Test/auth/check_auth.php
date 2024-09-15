<?php
if (!isset($_SESSION['user_id'])) {
    header("Location: ../register_login.php");
}
