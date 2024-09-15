<?php
require_once('../Model/db.php');
session_start();

require_once('../auth/check_auth.php');
require_once('../auth/check_retailer.php');
$sql = "SELECT * FROM user WHERE id = '" . $_SESSION['user_id'] . "'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $retailer_id = $_SESSION['user_id'];
    $f_name = mysqli_real_escape_string($conn, $_POST['f_name']);
    $l_name = mysqli_real_escape_string($conn, $_POST['l_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone_no = mysqli_real_escape_string($conn, $_POST['phone_no']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $store_name = mysqli_real_escape_string($conn, $_POST['store_name']);
    if ($_FILES['image']['name'] != "") {
        $imageFileName = $_FILES['image']['name'];
        $imageTmpName = $_FILES['image']['tmp_name'];
        $imageFileType = strtolower(pathinfo($imageFileName, PATHINFO_EXTENSION));

        if (getimagesize($imageTmpName)) {
            $uniqueImageName = uniqid() . '.' . $imageFileType;

            $uploadDirectory = "../public/media/profileImage/";
            move_uploaded_file($imageTmpName, $uploadDirectory . $uniqueImageName);

            $image = $uniqueImageName;
        } else {
            $errorMessage = "Invalid image file. Please upload a valid image.";
        }
    } else {
        $image = $row['image'];
    }

    $profile_sql = "UPDATE user SET f_name = '$f_name', l_name = '$l_name', email = '$email', phone_no = '$phone_no', address = '$address', store_name = '$store_name', image='$image' WHERE id = '$retailer_id'";
    if (mysqli_query($conn, $profile_sql)) {
        $successMessage = "Profile updated successfully.";
        $_SESSION['profile_pic'] = $image;
        $_SESSION['f_name'] = $f_name;
        $_SESSION['l_name'] = $l_name;

        header("Location: ./user_profile.php");
    } else {
        $errorMessage = "Error updating profile: " . mysqli_error($conn);
    }
}
