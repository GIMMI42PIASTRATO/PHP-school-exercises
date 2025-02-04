<?php

declare(strict_types=1);

function checkNumber(float $a, float $b)
{
    if ($b != 0) {

        if (($a - $b) > 1 / $b) {
            return "altezza";
        } else {
            return "età";
        }
    } else {
        return "Non posso dividere per zero";
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // ottenere i dati inviati dall'utente e convertirli in float
    $numeroA = (float) htmlspecialchars($_POST["numeroA"]);
    $numeroB = (float) htmlspecialchars($_POST["numeroB"]);

    // stampa stringa altezza se vera la condizione (A-B) > 1 / B
    $result = checkNumber($numeroA, $numeroB);

    echo "<h1>$result</h1>";
}
