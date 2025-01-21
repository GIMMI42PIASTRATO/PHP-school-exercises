<?php

declare(strict_types=1);

$errors = [];
$inputs = $_POST ?? [];
$dbSucces = null;
$dbError = null;

include __DIR__ . "/inc/get.php";
