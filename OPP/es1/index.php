<?php

declare(strict_types=1);
require_once './classes/converter.php';

$converter = new Converter();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Converter</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <main class="max-w-prose w-full mx-auto">
        <h1 class="text-5xl font-bold mb-4">Converter</h1>
        <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="border-slate-200 border rounded-lg p-4">
            <div class="flex gap-4 ">
                <div class="flex flex-col w-1/2">
                    <label for="value1" class="font-semibold text-sm">Value</label>
                    <input class="p-2 mb-4 border border-[#e4e4e7] rounded-md mt-2 bg-white text-slate-950" type="number" name="value1" id="value1" required>
                </div>

                <div class="flex flex-col w-1/2">
                    <label for="fromCurrency" class="font-semibold text-sm">From Currency</label>
                    <select name="fromCurrency" id="fromCurrency" class="p-2 mb-4 border border-[#e4e4e7] rounded-md mt-2 bg-white text-slate-950">
                        <?php foreach ($converter->exchangeRateTable->getExchangeRateTable() as $currency => $rate) : ?>
                            <option value="<?= $currency ?>"><?= $currency ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="flex flex-col">
                <label for="toCurrency" class="font-semibold text-sm">Currency</label>
                <select name="toCurrency" id="toCurrency" class="p-2 mb-4 border border-[#e4e4e7] rounded-md mt-2 bg-white text-slate-950">
                    <?php foreach ($converter->exchangeRateTable->getExchangeRateTable() as $currency => $rate) : ?>
                        <option value="<?= $currency ?>"><?= $currency ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <br />

            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $value1 = (int) $_POST["value1"];
                $fromCurrency = $_POST["fromCurrency"];
                $toCurrency = $_POST["toCurrency"];

                $converter->setValue1($value1);
                $result = $converter->convert($fromCurrency, $toCurrency);

                echo "<div class='flex flex-col'>";
                echo "<label for='result' class='font-semibold text-sm'>Result</label>";
                echo "<input class='p-2 mb-4 border border-[#e4e4e7] rounded-md mt-2 bg-white text-slate-950' type='text' name='result' id='result' value='$result' readonly>";
                echo "</div>";
            }
            ?>

            <br>
            <button type="submit" class="px-4 py-2 bg-zinc-900 text-white border-none rounded-md cursor-pointer font-medium text-sm w-full">Convert</button>
        </form>
    </main>
</body>

</html>