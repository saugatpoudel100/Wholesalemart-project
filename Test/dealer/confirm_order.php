<?php
require_once('../Model/db.php');
session_start();

require_once('../auth/check_auth.php');
require_once('../auth/check_dealer.php');

if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];
    $sql = "SELECT * FROM orders WHERE order_id = $order_id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    if ($row['dealer_id'] == $_SESSION['user_id']) {

        $sql_update = "UPDATE orders SET status='Delivered' WHERE order_id=$order_id ";

        if (mysqli_query($conn, $sql_update)) {
            header("Location: requested_price.php");
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }
    } else {
        echo "You are not authorized to approve this product.";
    }
} else {
    echo "Product ID not provided.";
}
