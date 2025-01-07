<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "BUSSANOVITTORIO";

try {
    // Database connection
    $db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Set the PDO error mode to EXCEPTION
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "DB connection failed: $e";
}
