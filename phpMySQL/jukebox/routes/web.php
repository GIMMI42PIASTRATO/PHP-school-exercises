<?php
// Controller imports
require_once __DIR__ . "/../controllers/DashboardController.php";
require_once __DIR__ . "/../controllers/HomeController.php";
require_once __DIR__ . "/../controllers/AuthController.php";
require_once __DIR__ . "/../controllers/SingersController.php";
require_once __DIR__ . "/../controllers/SongController.php";



// Define routes
Router::view("/", ["HomeController", "index"]);
Router::view("/auth/sign-in", ["AuthController", "signIn"]);
Router::view("/auth/sign-up", ["AuthController", "signUp"]);
Router::view("/dashboard", ["DashboardController", "index"]);
Router::view("/dashboard/addsinger", ["DashboardController", "addsinger"]);
Router::view("/dashboard/singer/:id", ["SingersController", "singerDetails"]);
Router::view("/dashboard/addSong", ["DashboardController", "addSong"]);
Router::view("/dashboard/song/:id", ["SongsController", "songDetails"]);
Router::view("/dashboard/search", ["DashboardController", "search"]);
