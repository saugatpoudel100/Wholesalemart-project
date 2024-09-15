<?php
require_once('../Model/db.php');
session_start();

require_once('../auth/check_auth.php');
require_once('../auth/check_dealer.php');

if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    $sql = "SELECT * FROM product WHERE id = $product_id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    if ($row['dealer_id'] == $_SESSION['user_id']) {

        $sql_update = "DELETE FROM product WHERE id=$product_id";

        if (mysqli_query($conn, $sql_update)) {
            header("Location: product_list.php");
        } else {
            echo "Something went wrong: " . mysqli_error($conn);
        }
    } else {
        echo "You are not authorized to approve this product.";
    }
} else {
    echo "Product ID not provided.";
}
