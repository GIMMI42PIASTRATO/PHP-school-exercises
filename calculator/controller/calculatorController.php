<?php

declare(strict_types=1);

require_once '../classes/ALU.php';

function sanitizeData($data)
{
    return htmlspecialchars(stripslashes(trim($data)));
};

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    session_start();

    $number = (float) sanitizeData($_POST["number"]);
    $operator = (float) sanitizeData($_POST["operator"]);

    if (!isset($number) || !isset($operator)) {
        $_SESSION["error"] = "Inserisci un numero e un operatore";
        header("Location: ../index.php");
        exit;
    }

    switch ($operator) {
        case "+":
            $result = ALU::add($_SESSION["result"], $number);
            break;

        case "-":
            $result = ALU::subtract($_SESSION["result"], $number);
            break;

        case "*":
            $result = ALU::multiply($_SESSION["result"], $number);
            break;

        case "/":
            $result = ALU::divide($_SESSION["result"], $number);
            break;
    }

    $_SESSION["result"] = $result;

    header("Location: ../index.php");
    exit;
}
