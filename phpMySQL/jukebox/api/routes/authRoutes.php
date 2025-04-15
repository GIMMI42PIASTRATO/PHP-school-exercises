<?php

// Router::post("/auth/register", )
Router::post("/auth/login", function (Request $req, Response $res) {
    $email = $req->body["email"];
    $password = $req->body["password"];



    $res->status(200)->send(["message" => "ciao"]);
});
