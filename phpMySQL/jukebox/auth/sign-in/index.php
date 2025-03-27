<?php

declare(strict_types=1);

$dbSucces = null;
$dbError = null;

$request_method = $_SERVER["REQUEST_METHOD"];

if ($request_method === "GET") {
    require_once __DIR__ . "/inc/get.php";
} elseif ($request_method === "POST") {
    require_once __DIR__ . "/inc/post.php";
}
