<?php

declare(strict_types=1);
require_once "./classes/index.php"
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accelerating vehicle</title>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap");

        * {
            font-family: "Inter", sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        main {
            max-width: 70ch;
            width: 100%;
            margin: 0 auto;
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 1rem;
            margin-top: 2rem;
            padding: 1rem;
            border-radius: 0.5rem;
            background-color: #f1f1f1;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .container:hover {
            background-color: #e1e1e1;
        }
    </style>
</head>

<body>
    <main>
        <?php
        $vehicle = new Vehicle();
        $autovehicle = new Autovehicle();
        $motocycle = new Motocycle();
        ?>

        <div class="container">
            <h1>Vehicle</h1>
            <p><?php $vehicle->accelerates(); ?></p>
        </div>

        <div class="container">
            <h1>Autovehicle</h1>
            <p><?php $autovehicle->accelerates(); ?></p>
        </div>

        <div class="container">
            <h1>Motocycle</h1>
            <p><?php $motocycle->accelerates(); ?></p>
        </div>
    </main>
</body>

</html>