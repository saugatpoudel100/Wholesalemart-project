<?php
require_once('../Model/db.php');
session_start();

require_once('../auth/check_auth.php');
require_once('../auth/check_dealer.php');

$sql = "SELECT * FROM user WHERE id = '" . $_SESSION['user_id'] . "'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$new_password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dealer_id = $_SESSION['user_id'];
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $hash = md5($password);

    $new_password = mysqli_real_escape_string($conn, $_POST['new_password']);
    $new_hash = md5($new_password);
    if ($hash == $row['password']) {
        $profile_sql = "UPDATE user SET password = '$new_hash' WHERE id = '$dealer_id'";
        if (mysqli_query($conn, $profile_sql)) {
            $successMessage = "Password updated successfully.";
            header("Location: ./user_profile.php");
        } else {
            $errorMessage = "Error updating password: " . mysqli_error($conn);
            header("Location: ./change_password.php?error=$errorMessage");
        }
    } else {
        $errorMessage = "Current password is incorrect.";
        header("Location: ./change_password.php?error=$errorMessage");
    }
}
