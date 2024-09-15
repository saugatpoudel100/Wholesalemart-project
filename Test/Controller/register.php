<?php
include '../Model/db.php';
session_start();


$f_name = mysqli_real_escape_string($conn, $_POST['f_name']);
$l_name = mysqli_real_escape_string($conn, $_POST['l_name']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$phone_no = mysqli_real_escape_string($conn, $_POST['phone_no']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
$hash = md5($password);
$acc_type = mysqli_real_escape_string($conn, $_POST['acc_type']);
$address = mysqli_real_escape_string($conn, $_POST['address']);
$store_name = mysqli_real_escape_string($conn, $_POST['store_name']);
if (isset($_FILES['image'])) {
    $imageFileName = $_FILES['image']['name'];
    $imageTmpName = $_FILES['image']['tmp_name'];
    $imageFileType = strtolower(pathinfo($imageFileName, PATHINFO_EXTENSION));

    // Check if the uploaded file is an image (you can add more checks if needed)
    if (getimagesize($imageTmpName)) {
        // Generate a unique name for the uploaded image (you can use a different method)
        $uniqueImageName = uniqid() . '.' . $imageFileType;

        // Move the uploaded file to a directory (you need to specify the directory path)
        $uploadDirectory = "../public/media/profileImage/"; // Change to your desired directory
        move_uploaded_file($imageTmpName, $uploadDirectory . $uniqueImageName);

        // Store the image file name in the database
        $profileImage = $uniqueImageName;
    } else {
        $errorMessage = "Invalid image file. Please upload a valid image.";
    }
}




$sql = "INSERT INTO user (f_name,l_name,email,phone_no,password,acc_type,address,store_name,image) VALUES ('$f_name','$l_name','$email','$phone_no','$hash','$acc_type','$address','$store_name','$profileImage')";

if (mysqli_query($conn, $sql)) {
    $_SESSION['msg'] = "Account created successfully";
    $_SESSION['msg_type'] = "success";
    header("location: ../register_login.php");
} else {
    $_SESSION['msg'] = "Error: " . $sql . "<br>" . mysqli_error($conn);
    $_SESSION['msg_type'] = "danger";
}

// Close connection
mysqli_close($conn);