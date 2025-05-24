<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

$host = "localhost";
$dbname = "localita";
$username = "root";
$password = "12345678";

$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);



if ($_SERVER["REQUEST_METHOD"] === "GET") {
    if (!isset($_GET["comune"])) {
        echo json_encode(["success" => false, "message" => "comune query parameter is required"]);
        exit;
    }

    $stmt = $conn->prepare("SELECT * FROM comuni WHERE name LIKE :name");
    $search = $_GET["comune"] . "%";
    $stmt->bindParam(":name", $search);
    $stmt->execute();

    echo json_encode($stmt->fetchAll());
}
