<?php
require_once __DIR__ . "/../lib/Controller.php";
require_once __DIR__ . "/../models/UserModel.php";

class DashboardController
{
    public static function index(Request $req, Response $res)
    {
        session_start();

        // Check if the user is authenticated
        if (!isset($_SESSION["user_id"])) {
            return $res->status(401)->redirect("./auth/sign-in");
        }

        // Get user data
        try {
            $userId = $_SESSION["user_id"];
            $user = UserModel::findUserById($userId);
        } catch (PDOException) {
            $res->view("errors/500");
            return;
        }

        if (!$user) {
            session_destroy();
            return $res->status(401)->redirect("./auth/sign-in");
        }

        // Render dashboard view
        $res->view("dashboard/index", ["user" => $user]);
    }

    public static function addsinger(Request $req, Response $res)
    {
        session_start();

        // Check if the user is authenticated
        if (!isset($_SESSION["user_id"])) {
            return $res->status(401)->redirect("./auth/sign-in");
        }

        // Get user data
        try {
            $userId = $_SESSION["user_id"];
            $user = UserModel::findUserById($userId);
        } catch (PDOException) {
            $res->view("errors/500");
            return;
        }

        // Render dashboard view
        $res->view("dashboard/addsinger", ["user" => $user]);
    }

    public static function addSong(Request $req, Response $res)
    {
        session_start();

        // Check if user is authenticated
        if (!isset($_SESSION["user_id"])) {
            return $res->redirect("/auth/sign-in");
        }

        // Render add song form
        return $res->view("dashboard/addSong");
    }

    public static function search(Request $req, Response $res)
    {
        session_start();

        // Check if the user is authenticated
        if (!isset($_SESSION["user_id"])) {
            return $res->status(401)->redirect("../auth/sign-in");
        }

        // Render search view
        $res->view("dashboard/search");
    }
}
