<?php

declare(strict_types=1);

session_start();

require_once "../classes/ALU.php";
require_once "../classes/CalculatorStack.php";

function sanitizeData(string $data)
{
    return htmlspecialchars(stripslashes(trim($data)));
};

function updateSerializedSession(string $name, $fun)
{
    $obj = unserialize($_SESSION[$name]);
    $fun($obj);
    $_SESSION[$name] = serialize($obj);
}

function precedence($op)
{
    if ($op === "+" || $op === "-") return 1;
    if ($op === "*" || $op === "/") return 2;
    return 0;
}

function evaluate($op, $a, $b)
{
    switch ($op) {
        case "+":
            return ALU::add($a, $b);

        case "-":
            return ALU::subtract($a, $b);

        case "*":
            return ALU::multiply($a, $b);

        case "/":
            return ALU::divide($a, $b);

        default:
            return 0;
    }
}

function calculateStack(CalculatorStack $stack)
{
    $operators = [];
    $values = [];

    foreach ($stack->get() as $token) {
        if (is_numeric($token)) {
            $values[] = $token;
        } else {
            while (!empty($operators) && precedence($operators[count($operators) - 1]) >= precedence($token)) {
                $b = array_pop($values);
                $a = array_pop($values);
                $op = array_pop($operators);
                $values[] = evaluate($op, $a, $b);
            }

            $operators[] = $token;
        }
    }

    while (!empty($operators)) {
        $b = array_pop($values);
        $a = array_pop($values);
        $op = array_pop($operators);
        $values[] = evaluate($a, $b, $op);
    }

    // Debug temporaneo
    error_log("Valore calcolato: " . $values[0]);
    return $values[0];
}




if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $input = sanitizeData($_POST["input"]);

    if (is_numeric($input)) {
        // input numerico
        $_SESSION["currentValue"] = ($_SESSION["currentValue"] === "0") ? $input : $_SESSION["currentValue"] . $input;
        $_SESSION["currentValue"] = ltrim($_SESSION["currentValue"], "0");
    } elseif (in_array($input, ["+", "-", "*", "/"])) {
        // input operatore
        $_SESSION["expressionDisplay"] .= $_SESSION["currentValue"] . $input;

        updateSerializedSession("stack", function ($stack) use ($input) {
            $stack->push($_SESSION["currentValue"]);
            $stack->push($input);
        });

        $_SESSION["currentValue"] = "0";
    } elseif ($input === "=") {
        updateSerializedSession("stack", function ($stack) {
            $stack->push($_SESSION["currentValue"]);

            // Debug temporaneo
            error_log("Contenuto dello stack prima del calcolo: " . print_r($stack->get(), true));

            $_SESSION["currentValue"] = (string) calculateStack($stack);
            $_SESSION["expressionDisplay"] = $stack->peek() . "=";
            $stack->set([]);
        });
    } elseif ($input === "C") {
        // Reset
        $_SESSION["expressionDisplay"] = "";
        $_SESSION["currentValue"] = 0;
        updateSerializedSession("stack", function ($stack) {
            $stack->set([]);
        });
    }



    header("Location: ../index.php");
    exit;
}
