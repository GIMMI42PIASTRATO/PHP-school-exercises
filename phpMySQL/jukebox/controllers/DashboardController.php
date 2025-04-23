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
        $userId = $_SESSION["user_id"];
        $user = UserModel::findUserById($userId);

        if (!$user) {
            session_destroy();
            return $res->status(401)->redirect("./auth/sign-in");
        }

        // Render dashboard view
        $res->view("dashboard/index", ["user" => $user]);
    }
}
