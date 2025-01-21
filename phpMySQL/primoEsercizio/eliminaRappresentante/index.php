<?php

declare(strict_types=1);

$errors = [];
$inputs = $_POST ?? [];
$dbSucces = null;
$dbError = null;

$request_method = strtoupper($_SERVER["REQUEST_METHOD"]);

if ($request_method === "GET") {
    include __DIR__ . "/inc/get.php";
} elseif ($request_method === "POST") {
    include __DIR__ . "/inc/post.php";

    include __DIR__ . "/inc/get.php";
}
