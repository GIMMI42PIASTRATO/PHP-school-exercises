<?php

declare(strict_types=1);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logaritmo e potenza</title>
</head>

<body>
    <?php
    function logPow(float $num1 = 0, float $num2 = 0, float $num3 = 0): float
    {
        if ($num1 && $num2 && $num3) {
            return $num3 ** 3;
        }

        if (($num1 && $num2) | ($num1  && $num3) | ($num2 && $num3)) {
            return $num2 ** 4;
        }

        if ($num1 | $num2 | $num3) {
            return log10($num1);
        }

        return 0;
    }

    echo "<h1>" . logPow(5, 4, 3) . "</h1>";
    ?>
</body>

</html>