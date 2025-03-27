<?php
if ($_SERVER["REQUEST_METHOD"] === "GET") {
    exit;
}

if ($_SERVER["CONTENT_TYPE"] === "application/json") {
    $data = json_decode(file_get_contents("php://input"));

    echo $data["email"] . " && " . $data["password"];
    exit;
}

if ($_SERVER["CONTENT_TYPE"] === "application/x-www-form-urlencoded") {
    echo json_encode(["email" => $_POST["email"], "password" => $_POST["password"]]);
    exit;
}


header("Content-Type: application/json");
echo json_encode(["message" => "not found"]);
