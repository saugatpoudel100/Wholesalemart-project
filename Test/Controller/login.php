<?php
include("../Model/db.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // username and password sent from form 

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $hash = md5($password);

    $sql = "SELECT * FROM user WHERE email = '$email' and password = '$hash'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

    $count = mysqli_num_rows($result);

    // If result matched $myusername and $mypassword, table row must be 1 row

    if ($count == 1) {
        $_SESSION['email'] = $email;
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['f_name'] = $row['f_name'];
        $_SESSION['l_name'] = $row['l_name'];
        $_SESSION['acc_type'] = $row['acc_type'];
        $_SESSION['profile_pic'] = $row['image'];
        if ($row['acc_type'] == "Dealer") {
            header("location: ../dealer/index.php");
        } else {

            header("location: ../retailer/index.php");
        }
    } else {
        $_SESSION['msg'] = "Your Login Email or Password is invalid";
        $_SESSION['msg_type'] = "danger";
        header("location: ../register_login.php");
    }
} else {
    $_SESSION['msg'] = "Your Login Email or Password is invalid";
    $_SESSION['msg_type'] = "danger";
    header("location: ../register_login.php");
}