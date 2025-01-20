<?php

declare(strict_types=1);

$errors = [];
$inputs = [];
$dbError = null;
$dbSucces = null;
$inputs = $_POST ?? [];

$request_method = strtoupper($_SERVER["REQUEST_METHOD"]);

if ($request_method === "GET") {
    // require the form
    require __DIR__ . "/inc/get.php";
} elseif ($request_method === "POST") {
    // require the logic to handle the for submission
    require __DIR__ . "/inc/post.php";
    // require again the form to show the errors or the success message
    require __DIR__ . "/inc/get.php";
}
