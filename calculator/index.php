<?php

declare(strict_types=1);

require_once './classes/Key.php';
require_once './classes/Keyboard.php';

$keyboard = new Keyboard();

$result = $_SESSION["result"] ?? 0;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calcolatrice</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js" type="module" defer></script>
</head>

<body>
    <main class="layout">
        <section class="display">
            <!-- calculator display -->
            <span class="expressionDisplay"></span>
            <span class="writableDisplay"></span>
        </section>
        <form class='keyboard' action="./controller/calculatorController.php" method="post">
            <!-- calculator keyboard -->
            <?= $keyboard ?>
        </form>
        <section class="memory">
            <!-- calculator memory or chronology  -->
            <h1>Memory</h1>
        </section>
    </main>
</body>

</html>