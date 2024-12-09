<?php

declare(strict_types=1);

session_start();

require_once 'classes/Calculator.php';
require_once './classes/Keyboard.php';
require_once './classes/Key.php';

$keyboard = new Keyboard();
$calculator = Calculator::create();
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
        try {
            $action = $_POST['memory'];
            $currentValue = $_POST["currentValue"];

            echo "I am here";

            switch ($action) {
                case 'MEM':
                    $result = $calculator->recallMemory();
                    $result = (string) $result;
                    $result = $currentValue . $result;
                    echo "<div>Big gyat result: $result</div>";
                    break;
                case 'STO':
                    if ($currentValue !== "" && $currentValue !== "0" && !is_numeric($currentValue)) {
                        throw new Exception();
                    }

                    $result = $calculator->storeToMemory((float) $currentValue);
                    break;
                case 'M+':
                    if ($currentValue !== "" && $currentValue !== "0" && !is_numeric($currentValue)) {
                        throw new Exception();
                    }

                    $calculator->addToMemory((float) $currentValue);
                    $result = $currentValue;
                    break;
            }
        } catch (Throwable $e) {
            // $result = $e->getMessage();
            echo "wut";
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
            <dialog class="nthSqrtDialog">
                <h3>Inserisci l'esponente della radice</h3>
                <label for="nthSqrtInput">Esponente</label>
                <input type="number" name="exponent" id="nthSqrtInput">
                <button type="button" id="exponentButton">Conferma</button>
            </dialog>
        </form>

        <section class="memory">
            <h1>Memoria</h1>
            <span><?= $calculator->hasMemory() ? $calculator->recallMemory() : "" ?></span>
        </section>
    </main>

    <script src="js/calculator.js"></script>
</body>

</html>