<?php

declare(strict_types=1);
require_once 'classes/converter.php';

$converter = new Converter();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Converter</title>
</head>

<body>
    <h1>Converter</h1>
    <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="value1">Value</label>
        <input type="number" name="value1" id="value1" required>
        <br>
        <label for="currency">Currency:</label>
        <select name="currency" id="currency">
            <?php foreach ($converter->getExchangeRateTable() as $currency => $rate) : ?>
                <option value="<?= $currency ?>"><?= $currency ?></option>
            <?php endforeach; ?>
        </select>
        <br>
        <button type="submit">Convert</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $value1 = $_POST["value1"];
        $currency = $_POST["currency"];

        $converter->setValue1((int) $value1);
        $convertedValue = $converter->convert($currency);

        echo "ciao";
        echo "<h1>$convertedValue</h1>";
    }
    ?>

</body>

</html>