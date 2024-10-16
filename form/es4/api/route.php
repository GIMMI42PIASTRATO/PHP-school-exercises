<?php

declare(strict_types=1);
session_start();

$users = [
    [
        "username" => "admin",
        "password" => "admin"
    ],
    [
        "username" => "Jhon",
        "password" => "12345678"
    ]
];

function findUserByUsername(string $username, array $users): array | null
{
    foreach ($users as $user) {
        if ($user["username"] === $username) {
            return $user;
        }

        return null;
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $user = findUserByUsername($username, $users);
    if (!$user) {
        $_SESSION["errors"] = ["username" => "Nessun utente trovato con questo username"];
        $_SESSION["formData"] = $_POST;
        header("Location: ../index.php");
        exit;
    }

    if ($user["password"] != $password) {
        $_SESSION["errors"] = ["password" => "Password errata"];
        $_SESSION["formData"] = $_POST;
        header("Location: ../index.php");
        exit;
    }

    $checkboxData = [];
    foreach ($_POST as $key => $value) {
        if ($key !== "username" && $key !== "password") {
            $checkboxData[] = $key;
        }
    }

    $_SESSION["checkboxData"] = $checkboxData;
    $_SESSION["user"] = $user;

    header("Location: ../dashboard/index.php");
    exit;
}
