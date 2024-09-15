<?php
require_once('../Model/db.php');
session_start();

require_once('../auth/check_auth.php');
require_once('../auth/check_dealer.php');

if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    $sql = "SELECT * FROM requested_price WHERE id = $product_id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    if ($row['dealer_id'] == $_SESSION['user_id']) {

        $sql_update = "UPDATE requested_price SET status=1 WHERE id=$product_id ";

        if (mysqli_query($conn, $sql_update)) {
            header("Location: approved_retailer.php");
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }
    } else {
        echo "You are not authorized to approve this product.";
    }
} else {
    echo "Product ID not provided.";
}
