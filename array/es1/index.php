<?php

declare(strict_types=1);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Random Filling</title>
</head>

<body>
    <?php
    function generateRandomArray(int $length): array
    {
        $arr = []; // Alternative sintaxs for array() WORK ONLY IN PHP 5.4+
        for ($i = 0; $i < $length; $i++) {
            $arr[] = rand(1, 100); // add an element to the end of the array
        }
        return $arr;
    }

    function findEvenNumbers(array $arr): array
    {
        $evenNumbers = [];
        foreach ($arr as $value) {
            if ($value % 2 === 0) {
                $evenNumbers[] = $value;
            }
        }
        return $evenNumbers;
    }

    $arr = generateRandomArray(20);
    $evenNumbers = findEvenNumbers($arr);

    echo "<h1>Numeri Pari: " . count($evenNumbers) . "</h1>";
    echo "<h1>Numeri Dispari: " . count($arr) - count($evenNumbers) . "</h1>";

    echo "<h1>Array Completo</h1>";
    sort($arr);
    echo var_dump($arr);
    ?>

</body>

</html>