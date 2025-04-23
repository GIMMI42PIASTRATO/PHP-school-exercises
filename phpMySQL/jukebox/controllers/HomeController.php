<?php

class HomeController
{
    public static function index(Request $req, Response $res)
    {
        session_start();

        $isAuthenticated = isset($_SESSION["user_id"]);

        // Render home view
        $res->view("home/index", ["isAuthenticated" => $isAuthenticated]);
    }
}
