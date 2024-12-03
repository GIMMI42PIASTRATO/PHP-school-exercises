<?php

declare(strict_types=1);

require_once "../classes/ALU.php";
require_once "../classes/CalculatorStack.php";

if (!isset($_SESSION["expressionDisplay"])) {
    $_SESSION["expressionDisplay"] = "";
    $_SESSION["currentValue"] = 0;
    $_SESSION["stack"] = CalculatorStack::create();
}

function sanitizeData(string $data)
{
    return htmlspecialchars(stripslashes(trim($data)));
};

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

    return $values[0];
}




if ($_SERVER["REQUEST_METHOD"] === "POST") {
    session_start();

    $number = sanitizeData($_POST["number"] ?? null);
    $operator = sanitizeData($_POST["operator"] ?? null);

    if ($number === null || $operator === null) {
        $_SESSION["error"] = "Invalid data";
        header("Location: ../index.php");
        exit;
    }



    header("Location: ../index.php");
    exit;
}
