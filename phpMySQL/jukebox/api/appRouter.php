<?php

declare(strict_types=1);
require_once __DIR__ . "/lib/Router.php";

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

include_once __DIR__ . "/routes/authRoutes.php";
include_once __DIR__ . "/routes/userRoutes.php";

Router::run();
