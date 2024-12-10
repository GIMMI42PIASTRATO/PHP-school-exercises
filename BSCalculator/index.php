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

            switch ($action) {
                case 'MEM':
                    $result = $calculator->recallMemory();
                    $result = (string) $result;
                    $result = $currentValue . $result;
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
                <label for="nthSqrtInput" id="nthSqrtLabel">Esponente</label>
                <div style="display: flex; align-items: center; gap: 1rem;">
                    <input type="number" name="exponent" id="nthSqrtInput" min="2">
                    <button type="button" id="exponentButton">Conferma</button>
                </div>
                <div id="nthSqrtError"></div>
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