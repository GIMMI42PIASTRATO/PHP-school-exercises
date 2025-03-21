<?php

$servername = "localhost";
$username = "root";

try {
    $conn = new PDO("mysql:host=$servername;dbname=centri", $username);
    # Set the error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Database connected succesfully";
} catch (PDOException $e) {
    echo "Connection failed: $e";
}
