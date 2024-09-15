<?php
include("../Model/db.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dealer_id = $_SESSION['user_id'];
    $year = $_POST['year'];

    $sql_annual_sale = "SELECT SUM(total_amount) AS total_revenue FROM orders WHERE dealer_id = '$dealer_id' AND status = 'Delivered' AND YEAR(order_date) = '$year'";
    $annual_sale_result = mysqli_query($conn, $sql_annual_sale);
    $total_annual_sale = mysqli_fetch_assoc($annual_sale_result);
    if ($total_annual_sale['total_revenue'] > 0) {
        echo intval($total_annual_sale['total_revenue']);
    } else {
        echo "0";
    }

} else {
    // Handle invalid request
    http_response_code(400); // Bad Request
    echo "Invalid request";
}
?>