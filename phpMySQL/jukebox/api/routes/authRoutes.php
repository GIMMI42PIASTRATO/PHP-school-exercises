<?php
include_once __DIR__ . "/../controllers/authController.php";

Router::post("/auth/register", ["AuthController", "register"]);
Router::post("/auth/login", ["AuthController", "login"]);
