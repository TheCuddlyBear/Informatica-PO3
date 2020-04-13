<?php
include("config.php");
session_start();


$product_id = $_GET['id'];
$prijs = $_GET['prijs'];

if(empty($_SESSION['order_id'])){
  $_SESSION['order_id'] = rand(1,99999);

  $checkIfIdExists = "SELECT * FROM bestelling WHERE order_id = " . $_SESSION['order_id'];
  $result = mysqli_query($conn, $checkIfIdExists);
  $rowcount = mysqli_num_rows($result);

  if($rowcount >= 1){
    die();
  }else {
    echo "wow dit is echt goed";
    $order_id = $_SESSION['order_id'];
   
    $createorder = "INSERT INTO bestelling (order_id, betaalmethode, datum, email) VALUES ('$order_id', 'undefined', '4-6-2020', 'undefined')";
    $mysqlExecute = mysqli_query($conn, $createorder);
    if(!$mysqlExecute){
      echo "Er is een fout opgetreden";
    }else{
      echo "Wow het heeft gewerkt!";
      $order_id = $_SESSION['order_id'];
      $createBestelregel = "INSERT INTO bestelregel (aantal, product_id, product_prijs, order_id) VALUES ('1', '$product_id', '$prijs', '$order_id')";
      $resultaat = mysqli_query($conn, $createBestelregel);
      if(!$resultaat){
        echo "Fout!";
      }else{
        header("location: producten.php");
      }

    }
  }

}else {
  echo "wow<br>";
  $order_id = $_SESSION['order_id'];
      $createBestelregel = "INSERT INTO bestelregel (aantal, product_id, product_prijs, order_id) VALUES ('1', '$product_id', '$prijs', '$order_id')";
      $resultaat = mysqli_query($conn, $createBestelregel);
      if(!$resultaat){
        echo "Fout!";
      }else{
        header("location: producten.php");
      }
}
