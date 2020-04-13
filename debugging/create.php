<?php
include("../config.php");
$password = "LotteH21";
$hashpassword = password_hash($password, PASSWORD_DEFAULT);


$query = "INSERT INTO users (username, password) VALUES ('lotteham', '" . $hashpassword . "')";
$result = mysqli_query($conn, $query);

if($result){
  echo "yes";
}else{
  echo "wrong";
}

?>