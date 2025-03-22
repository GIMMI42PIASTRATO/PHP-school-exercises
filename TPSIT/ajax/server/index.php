<?php

header("Content-Type: application/json");

$response = ["message" => "Questo mesaggio proviene dal server"];
echo json_encode($response);
