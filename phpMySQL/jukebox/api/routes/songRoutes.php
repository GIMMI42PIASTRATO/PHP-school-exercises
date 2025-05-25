<?php
include_once __DIR__ . "/../../controllers/SongController.php";

Router::post("/songs/create", ["SongsController", "create"]);
Router::delete("/songs/delete/:id", ["SongsController", "delete"]);
Router::post("/songs/update/:id", ["SongsController", "update"]);
