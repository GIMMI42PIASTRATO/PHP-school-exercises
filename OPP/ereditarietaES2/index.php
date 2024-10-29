<?php

declare(strict_types=1);
require_once 'classes/index.php';

$vehicle = new Vehicle('Toyota', new DateTime('2010-01-01'));
$car = new Car("Tesla", new DateTime('2020-01-01'), "Model S");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cars</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap');

        * {
            font-family: 'Montserrat', sans-serif;
        }
    </style>
</head>

<body>
    <h1><?= $vehicle->getInfo() ?></h1>
    <br>
    <h3>Category: <?= Vehicle::category() ?></h3>
    <br>
    <h1><?= $car->getInfo() ?></h1>
    <br>
    <h3>Category: <?= Car::category() ?></h3>
</body>

</html>