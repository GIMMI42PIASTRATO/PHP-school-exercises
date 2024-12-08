<?php

declare(strict_types=1);

require_once 'classes/Calculator.php';
require_once './classes/Keyboard.php';
require_once './classes/Key.php';

$keyboard = new Keyboard();
$calculator = new Calculator();
$result = '';
$error = '';
$memory = '';

// Gestione azioni POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST["currentValue"]) && isset($_POST["operator"]) && $_POST["operator"] !== "") {
        $expression = $_POST['currentValue'];
        $operator = $_POST['operator'];
        // $exponent = $_POST['exponent'] ?? null;
        $result = $calculator->calculate($expression, $operator);
    }

    if (isset($_POST['memory'])) {
        $action = $_POST['memory'];
        $currentValue = $_POST["currentValue"];

        echo "<div>Current value is numeric: " . is_numeric($currentValue) . "</div>";

        try {
            switch ($action) {
                case 'MEM':
                    $result = $calculator->recallMemory();
                    break;
                case 'STO':
                    if (!is_numeric($currentValue)) {
                        throw new Exception();
                    }

                    $result = $calculator->storeToMemory($currentValue);
                    break;
                case 'M+':
                    $result = $calculator->addToMemory($currentValue);
                    break;
            }
        } catch (Throwable $e) {
            $result = "Espressione non valida";
        }
    }
}

$hasMemory = $calculator->hasMemory();
?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <title>Calcolatrice Scientifica</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <main class="layout">
        <section class="display">
            <?php if ($hasMemory): ?>
                <div class="memory-indicator">M</div>
            <?php endif; ?>
            <span type="text" id="display"><?= $result ?></span>
        </section>

        <form method="post" id="calculatorForm" class="keyboard">
            <?= $keyboard  ?>
        </form>

        <section class="memory">
            <h1>Memoria</h1>
            <span><?= $calculator->hasMemory() ? $calculator->recallMemory() : "" ?></span>
        </section>
    </main>

    <script src="js/calculator.js"></script>
</body>

</html>