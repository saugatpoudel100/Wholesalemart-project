<?php
require_once('../Model/db.php');
session_start();

require_once('../auth/check_auth.php');
require_once('../auth/check_retailer.php');

if (isset($_GET['dealer_id'])) {
    $dealer_id = $_GET['dealer_id'];
    $product_id = $_GET['product_id'];
    $retailer_id = $_SESSION['user_id'];
    $sql = "SELECT * FROM user WHERE id = $dealer_id AND acc_type='Dealer'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    if ($count) {
        $requested_sql = "SELECT * FROM requested_price WHERE dealer_id = $dealer_id AND retailer_id = $retailer_id";
        $requested_result = mysqli_query($conn, $requested_sql);
        $requested_row = mysqli_fetch_array($requested_result, MYSQLI_ASSOC);
        $requested_count = mysqli_num_rows($requested_result);
        if ($requested_count) {
            echo "Already Requested";
        } else {
            if (isset($_GET['product_id'])) {
                $sql = "INSERT INTO requested_price (dealer_id, retailer_id) VALUES ($dealer_id, $retailer_id)";
                if (mysqli_query($conn, $sql)) {
                    header("Location: product_detail.php?product_id=" . $product_id);
                } else {
                    echo "Something went wrong: " . mysqli_error($conn);
                }
            } else {
                echo "Product Id not provided";
            }
        }
    } else {
        echo "Dealer not found";
    }
} else {
    echo "Dealer Id Not provided";
}
