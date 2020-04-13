<?php
include("../config.php");
date_default_timezone_set('Europe/Amsterdam');

// Completed orders stats & completed orders voor grafiek
$totalOrdersQuery = "SELECT * FROM trackentrace";
$result = mysqli_query($conn, $totalOrdersQuery);
$totalorders = mysqli_num_rows($result);

$completedQuery = "SELECT * FROM trackentrace WHERE status = 4";
$resultCompleted = mysqli_query($conn, $completedQuery);
$completedOrders = mysqli_num_rows($resultCompleted);

$percentage = ceil(100 / $totalorders * $completedOrders);

// Pending orders + grafiek
$pendingOrderQuery = "SELECT * FROM trackentrace WHERE status = 1";
$resultPending = mysqli_query($conn, $pendingOrderQuery);
$pendingOrders = mysqli_num_rows($resultPending);

$sentOrderQuery = "SELECT * FROM trackentrace WHERE status = 2";
$resultSent = mysqli_query($conn, $sentOrderQuery);
$sentOrders = mysqli_num_rows($resultSent);

$otwOrderQuery = "SELECT * FROM trackentrace WHERE status = 3";
$resultOTW = mysqli_query($conn, $otwOrderQuery);
$otwOrders = mysqli_num_rows($resultOTW);

// Earnings monthly
$monthToday = date('m');

$monthQuery = "SELECT * FROM bestelling WHERE datum LIKE '%$monthToday%'";
$resultMonth = mysqli_query($conn, $monthQuery);
$earnings = 0;

while($row = $resultMonth->fetch_assoc()){
    $earnings = $earnings + $row['totalprice'];
}

// Earnings yearly
$yearToday = date('Y');

$yearQuery = "SELECT * FROM bestelling WHERE datum LIKE '%$yearToday%'";
$resultYear = mysqli_query($conn, $yearQuery);
$yearEarnings = 0;

while($row = $resultYear->fetch_assoc()){
    $yearEarnings = $yearEarnings + $row['totalprice'];
}
?>