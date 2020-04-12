<?php
include("../config.php");
$productid = $_GET['id'];

$sql = "DELETE FROM product WHERE id = $productid";
mysqli_query($conn, $sql);
header("location: ../admin/products.php");
?>