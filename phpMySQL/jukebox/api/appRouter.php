<?php

declare(strict_types=1);
// require_once __DIR__ . "/lib/Router.php";

Router::get('/users/:userId', function ($req, $res) {
    $userId = $req->params['userId'];
    $data = ['userId' => $userId, 'name' => 'Mario Rossi'];

    $res->status(200)->json($data);
});

Router::post('/users', function ($req, $res) {
    $newUser = $req->body;
    // Salva l'utente...

    $res->status(201)->json(['message' => 'User created', 'user' => $newUser]);
});

Router::run();
