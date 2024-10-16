<?php

declare(strict_types=1);
require __DIR__ . '/calculate.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard ristorante online</title>
    <style>
        form {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            width: 300px;
            margin: 0 auto;
        }

        label {
            font-size: 1.2rem;
        }

        select {
            padding: 0.5rem;
            font-size: 1rem;
        }

        button {
            padding: 0.5rem;
            font-size: 1rem;
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }
    </style>
</head>

<body>


    <?php
    $total = 0;
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $total += $_POST["appetizers"];
        $total += $_POST["firstCourses"];
        $total += $_POST["secondCourses"];
        $total += $_POST["sides"];
        $total += $_POST["drinks"];
    }
    ?>


    <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
        <label for="appetizers">Antipasto</label>
        <select name="appetizers" id="appetizers">
            <?php foreach ($appetizers as $name => $price) : ?>
                <option value="<?= $price ?>" <?= isset($_POST["appetizers"]) && $_post["appetizers"] == $price ? 'selected' : "" ?>>
                    <?= $name ?> - <?= $price ?>€
                </option>
            <?php endforeach; ?>
        </select>

        <label for="firstCourses">Primo piatto</label>
        <select name="firstCourses" id="firstCourses">
            <!-- Nuova  sintassi scoperta -->
            <!-- short echo tags: funziona uguale ad aprire un tag php e poi inserire l'istruzione echo per stampare qualcosa -->
            <!-- La sintassi per il foreach è una sinstassi alternative per le strutture di controllo, quindi esiste per gli if switch ecc... -->
            <?php foreach ($firstCourses as $name => $price) : ?>
                <option value="<?= $price ?>" <?= isset($_POST["firstCourses"]) && $_POST["firstCourses"] == $price ? 'selected' : "" ?>>
                    <?= $name ?> - <?= $price ?>€
                </option>
            <?php endforeach; ?>
        </select>

        <label for="secondCourses">Secondo piatto</label>
        <select name="secondCourses" id="secondCourses">
            <?php foreach ($secondCourses as $name => $price) : ?>
                <option value="<?= $price ?>" <?= isset($_POST["secondCourses"]) && $_POST["secondCourses"] == $price ? 'selected' : "" ?>>
                    <?= $name ?> - <?= $price ?>€
                </option>
            <?php endforeach; ?>
        </select>

        <label for="sides">Contorno</label>
        <select name="sides" id="sides">
            <?php foreach ($sides as $name => $price) : ?>
                <option value="<?= $price ?>" <?= isset($_POST["sides"]) && $_POST["sides"] == $price ? 'selected' : "" ?>>
                    <?= $name ?> - <?= $price ?>€
                </option>
            <?php endforeach; ?>
        </select>

        <label for="drinks">Bevanda</label>
        <select name="drinks" id="drinks">
            <?php foreach ($drinks as $name => $price) : ?>
                <option value="<?= $price ?>" <?= isset($_POST["drinks"]) && $_POST["drinks"] == $price ? 'selected' : "" ?>>
                    <?= $name ?> - <?= $price ?>€
                </option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Submit</button>
        <h2><?= $total ?>€</h2>
    </form>
</body>

</html>