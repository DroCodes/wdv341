<?php
$servername = "localhost";
//$username = "ddaigh91_wdv341";
//$password = "Oliver2018!";

$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=localhost; port = 3306;dbname=ddaigh_wdv341", $username, $password );
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//    echo "Connected successfully";
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>