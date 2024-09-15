<?php
include("../Model/db.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $retailer_id = $_SESSION['user_id'];
    $year = $_POST['year'];

    $sql_annual_purchase = "SELECT SUM(total_amount) AS total_revenue FROM orders WHERE user_id = '$retailer_id' AND status = 'Delivered' AND YEAR(order_date) = '$year'";
    $annual_purchase_result = mysqli_query($conn, $sql_annual_purchase);
    $total_annual_purchase = mysqli_fetch_assoc($annual_purchase_result);
    if ($total_annual_purchase['total_revenue'] > 0) {
        echo intval($total_annual_purchase['total_revenue']);
    } else {
        echo "0";
    }

} else {
    // Handle invalid request
    http_response_code(400); // Bad Request
    echo "Invalid request";
}
?>