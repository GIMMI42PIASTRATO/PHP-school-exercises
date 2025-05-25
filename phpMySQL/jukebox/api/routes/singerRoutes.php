<?php
include_once __DIR__ . "/../../controllers/SingersController.php";

Router::post("/singers/create", ["SingersController", "create"]);
Router::delete("/singers/delete/:id", ["SingersController", "delete"]);
Router::post("/singers/update/:id", ["SingersController", "update"]);
