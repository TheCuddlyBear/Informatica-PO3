<?php
session_start();

unset($_SESSION['loggedin']);
unset($_SESSION['fullname']);
unset($_SESSION['avatar']);

header("location: index.php");

?>