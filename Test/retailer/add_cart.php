<?php
include '../Model/db.php';
session_start();

$user_id = $_SESSION['user_id'];
$product_id = $_POST['product_id'];
$quantity = $_POST['quantity'];
$submit = $_POST['update'];

$check_query = "SELECT * FROM cart_items WHERE user_id = '$user_id' AND product_id = '$product_id'";
$result = mysqli_query($conn, $check_query);

$product_sql = "SELECT * FROM product WHERE id = '$product_id'";
$product_result = mysqli_query($conn, $product_sql);
$row = mysqli_fetch_array($product_result, MYSQLI_ASSOC);
if ($row['stock'] >= $quantity) {

    if ($submit == "Update") {
        $update_query = "UPDATE cart_items SET quantity = $quantity WHERE user_id = $user_id AND product_id = $product_id";
        mysqli_query($conn, $update_query);
        header('location: ../retailer/cart.php');
    } else {

        if (mysqli_num_rows($result) > 0) {
            $update_query = "UPDATE cart_items SET quantity = quantity + $quantity WHERE user_id = $user_id AND product_id = $product_id";
            mysqli_query($conn, $update_query);
            // $update_product = "UPDATE product SET stock = stock - $quantity WHERE id = $product_id";
            // mysqli_query($conn, $update_product);
            header('location: ../retailer/cart.php');
        } else {
            $insert_query = "INSERT INTO cart_items (user_id, product_id,dealer_id, quantity, price) VALUES ($user_id, $product_id, $row[dealer_id], $quantity, $row[price])";
            mysqli_query($conn, $insert_query);
            // $update_product = "UPDATE product SET stcart_itemsock = stock - $quantity WHERE id = $product_id";
            // mysqli_query($conn, $update_product);
            header('location: ../retailer/cart.php');
        }
    }
} else {
    echo "Out of stock";
}
