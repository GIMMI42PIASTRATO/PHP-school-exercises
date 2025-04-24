<?php

declare(strict_types=1);
require_once __DIR__ . "/../lib/Router.php";

// test routes
Router::get('/users/:userId', function (Request $req, Response $res) {
    $userId = $req->params['userId'];
    $data = ['userId' => $userId, 'name' => 'Mario Rossi'];

    // echo json_encode($data);
    $res->status(200)->json($data);
});

Router::post('/users', function (Request $req, Response $res) {
    $newUser = $req->body;
    // Salva l'utente...

    $res->status(201)->json(['message' => 'User created', 'user' => $newUser]);
});
// end test routes

include_once __DIR__ . "/routes/authRoutes.php";
include_once __DIR__ . "/routes/userRoutes.php";
include_once __DIR__ . "/routes/singerRoutes.php";
include_once __DIR__ . "/routes/songRoutes.php";

Router::run(true);
