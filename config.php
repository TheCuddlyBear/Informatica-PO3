<?php
define('DB_SERVER', '83.172.160.71');
define('DB_USER', 'bash_table');
define('DB_PASS', 'Hallotabel123');
define('DB_NAME', 'bash_pop3');

try{
    $pdo = new PDO("mysql:dbhost=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
}catch(PDOException $e){
    echo "<div class='alert alert-danger' style='margin:10px' role='alert'>";
    echo "An error has occured: " . $e;
    echo "</div";
}