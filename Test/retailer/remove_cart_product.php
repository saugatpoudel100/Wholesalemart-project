<?php
include '../Model/db.php';
session_start();

$user_id = $_SESSION['user_id'];
$product_id = $_GET['product_id'];
if (isset($product_id)) {
    $check_query = "SELECT * FROM cart_items WHERE user_id = '$user_id' AND product_id = '$product_id'";
    $result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($result) > 0) {
        $delete_query = "DELETE FROM cart_items WHERE user_id = $user_id AND product_id = $product_id";
        mysqli_query($conn, $delete_query);
        header('location: ../retailer/cart.php');
    } else {
        echo "No product found";
    }
} else {
    echo "No product found";
}
