<?php
//ใช้ host
// $hostname = "localhost";
// $databasename = "vms";
// $username = "root";
// $password = "root";

// ใช้ในเครื่อง
$hostname = "127.0.0.1";
$databasename = "vms";
$username = "Siriwat";
$password = "123456789";

try {
    $conn = new PDO("mysql:host={$hostname};dbname={$databasename}"
    , $username, $password , array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
?>
