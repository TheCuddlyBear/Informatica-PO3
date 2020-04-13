<?php
include("../config.php");
$productid = $_GET['id'];
$orderid = $_GET['orderid'];

if(!empty($productid)) {
    $sql = "DELETE FROM product WHERE id = $productid";
    if (mysqli_query($conn, $sql)) {
        header("location: ../admin/products.php?alert=removeSuccess");
    } else {
        header("location: ../admin/products.php?alert=removeFailed");
    }
}else{
    $sqlOrder = "DELETE FROM bestelling WHERE order_id = $orderid";
    $sqlTrack = "DELETE FROM trackentrace WHERE order_id = $orderid";
    if (mysqli_query($conn, $sqlOrder) && mysqli_query($conn, $sqlTrack)) {
        header("location: ../admin/orders.php?alert=removeSuccess");
    } else {
        header("location: ../admin/orders.php?alert=removeFailed");
    }
}
?>