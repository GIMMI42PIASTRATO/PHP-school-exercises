<?php

declare(strict_types=1);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Operazioni tra due numeri</title>
    <style>
        pre {
            color: red;
        }
    </style>
</head>

<body>
    <?php
    function ALU(float $num1, float $num2, string $operator): float | string
    {
        switch ($operator) {
            case "+":
                return $num1 + $num2;

            case "-":
                return $num1 - $num2;

            case "*":
                return $num1 * $num2;

            case "/":
                if ($num2 === 0) {
                    return "<pre>ERROR: Can't divide by ZERO</pre>";
                }

                return $num1 / $num2;
            default:
                return "<pre>ERROR: Enter a valid operator</pre>";
        }
    }

    echo "<h1>" . ALU(5, 2, "ciao") . "</h1>";
    ?>
</body>

</html>