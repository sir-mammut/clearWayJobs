<?php


global $conn;

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "clearway_db";

      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



?>
