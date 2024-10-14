<?php

declare(strict_types=1);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Array Associativo</title>
</head>

<body>
    <?php
    $provinciaSiglaArr = array("Torino" => "TO", "Milano" => "MI", "Roma" => "RM", "Genova" => "GE", "Bologna" => "BO", "Napoli" => "NA", "Bari" => "BA", "Cagliari" => "CA", "Palermo" => "PA", "Catanzaro" => "CZ");

    ?>

    <form>
        <label for="search">Provincia</label>
        <select>
            <?php
            foreach ($provinciaSiglaArr as $key => $value) {
                echo "<option value='$value'>$key => $value</option>";
            }
            ?>
        </select>
    </form>
</body>

</html>