<?php

function sanitizeData($data)
{
    return htmlspecialchars(stripslashes(trim($data)));
};

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    session_start();

    $number = sanitizeData($_POST["number"]);
    $operator = sanitizeData($_POST["operator"]);

    if (!isset($number) && !isset($operator)) {
        $_SESSION["error"] = "Inserisci un numero e un operatore";
        header("Location: ../index.php");
        exit;
    }
}
