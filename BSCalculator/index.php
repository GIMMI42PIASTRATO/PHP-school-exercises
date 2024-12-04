<?php
require_once 'classes/Calculator.php';

$calculator = new Calculator();
$result = '';
$error = '';
$memory = '';

// Gestione azioni POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['calculate'])) {
        $expression = $_POST['expression'];
        $result = $calculator->calculate($expression);
    }

    if (isset($_POST['memory'])) {
        $action = $_POST['memory'];
        $currentValue = isset($_POST['currentValue']) ? floatval($_POST['currentValue']) : 0;

        switch ($action) {
            case 'MR':
                $result = $calculator->recallMemory();
                break;
            case 'MS':
                $result = $calculator->storeToMemory($currentValue);
                break;
            case 'M+':
                $result = $calculator->addToMemory($currentValue);
                break;
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
    <div class="calculator">
        <?php if ($hasMemory): ?>
            <div class="memory-indicator">M</div>
        <?php endif; ?>

        <form method="post" id="calculatorForm">
            <input type="text" id="display" name="expression" value="<?php echo htmlspecialchars($result); ?>" readonly>

            <div class="buttons">
                <div class="memory-buttons">
                    <button type="submit" name="memory" value="MR">MR</button>
                    <button type="submit" name="memory" value="MS">MS</button>
                    <button type="submit" name="memory" value="M+">M+</button>
                </div>

                <div class="scientific-buttons">
                    <button type="button" onclick="addToDisplay('sin(')">sin</button>
                    <button type="button" onclick="addToDisplay('cos(')">cos</button>
                    <button type="button" onclick="addToDisplay('tan(')">tan</button>
                    <button type="button" onclick="addToDisplay('^')">^</button>
                    <button type="button" onclick="addToDisplay('sqrt(')">√</button>
                    <button type="button" onclick="addToDisplay('!')">n!</button>
                </div>

                <div class="number-buttons">
                    <?php for ($i = 9; $i >= 0; $i--): ?>
                        <button type="button" onclick="addToDisplay('<?php echo $i; ?>')"><?php echo $i; ?></button>
                    <?php endfor; ?>
                    <button type="button" onclick="addToDisplay('.')">.</button>
                </div>

                <div class="operator-buttons">
                    <button type="button" onclick="addToDisplay('+')">+</button>
                    <button type="button" onclick="addToDisplay('-')">-</button>
                    <button type="button" onclick="addToDisplay('*')">*</button>
                    <button type="button" onclick="addToDisplay('/')">/</button>
                    <button type="submit" name="calculate" value="1">=</button>
                </div>

                <div class="control-buttons">
                    <button type="button" onclick="clearDisplay()">C</button>
                    <button type="button" onclick="backspace()">⌫</button>
                </div>
            </div>
        </form>
    </div>

    <script src="js/calculator.js"></script>
</body>

</html>