<?php
// Controller imports
require_once __DIR__ . "/../controllers/DashboardController.php";
require_once __DIR__ . "/../controllers/HomeController.php";
require_once __DIR__ . "/../controllers/AuthController.php";

// Define routes
Router::view("/dashboard", ["DashboardController", "index"]);
Router::view("/", ["HomeController", "index"]);
Router::view("/auth/sign-in", ["AuthController", "signIn"]);
Router::view("/auth/sign-up", ["AuthController", "signUp"]);
