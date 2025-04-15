<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");

$baseDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
define('BASE_PATH', $baseDir === '/' ? '' : $baseDir);


require_once "appRouter.php";
