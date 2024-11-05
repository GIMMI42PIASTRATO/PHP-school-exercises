<?php

declare(strict_types=1);

// dichiarazione dell'array
$ARR_Cavallo_altezza = array();

// inserimento di 10 valori causuali tra 1 e 100 nell'array
for ($i = 0; $i < 10; $i++) {
    $ARR_Cavallo_altezza["altezza$i"] = random_int(1, 100);
}

// ordinare l'array associativo in ordine decrescente per i valori
arsort($ARR_Cavallo_altezza);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <table>
        <thead>
            <tr>
                <td>Chiave</td>
                <td>Valore</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($ARR_Cavallo_altezza as $key => $value) : ?>
                <tr>
                    <td><?= $key ?></td>
                    <td><?= $value ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</body>

</html>