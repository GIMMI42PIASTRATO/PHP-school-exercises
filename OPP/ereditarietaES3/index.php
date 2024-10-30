<?php

declare(strict_types=1);
require_once "classes/shapes.php";

$square = new Square(5);
$triangle = new Triangle(3, 4, 5);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shapes</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        * {
            font-family: 'Inter', sans-serif;
            box-sizing: border-box;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            margin: 0;
            padding: 0;
            height: 100vh;
            background-color: #f9f9f9;
        }

        main {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        section {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 20px;
        }

        h1 {
            font-size: 2rem;
            margin-bottom: 10px;
        }

        h2 {
            font-size: 1.5rem;
            margin-bottom: 10px;
        }

        p {
            font-size: 1rem;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <h1>Geometric figures</h1>
    <main>
        <section>
            <h2>Square</h2>
            <p><?= $square->description() ?></p>
            <p>Number of sides: <?= Square::NUMBER_OF_SIDES ?></p>
            <p>Side length: <?= $square->getSideLenght() ?></p>
            <p>Area: <?= $square->calculateArea() ?></p>
        </section>

        <section>
            <h2>Triangle</h2>
            <p><?= $triangle->description() ?></p>
            <p>Number of sides: <?= Triangle::NUMBER_OF_SIDES ?></p>
            <p>Side 1 length: <?= $triangle->getSideLenght1() ?></p>
            <p>Side 2 length: <?= $triangle->getSideLenght2() ?></p>
            <p>Side 3 length: <?= $triangle->getSideLenght3() ?></p>
            <p>Area: <?= $triangle->calculateArea() ?></p>
        </section>
    </main>
</body>

</html>