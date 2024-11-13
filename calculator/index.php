<?php
declare(strict_types=1);

require_once './class/Key.php';
require_once './class/Keyboard.php';

$keyboard = new Keyboard();
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
            <h1>Test</h1>
        </section>
        <section class='keyboard'>
            <!-- calculator keyboard -->
            <?= $keyboard ?>
        </section>
        <section class="memory">
            <!-- calculator memory or chronology  -->
            <h1>Memory</h1>
        </section>
    </main>
</body>

</html>