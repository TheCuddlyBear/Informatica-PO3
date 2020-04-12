<?php
define('DB_SERVER', 'localhost');
define('DB_USER', 'bash_table');
define('DB_PASS', 'Hallotabel123');
define('DB_NAME', 'bash_pop3');

$conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

// Check connection
if (!$conn) {
    $error = mysqli_connect_error();
}