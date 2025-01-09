<?php

declare(strict_types=1);
include_once "../db/db.php";
include_once "../utils/helper.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $regione = sanitizeData($_POST["regione"]);

    // Increase provvigione by 2% for rappresentante with ultimo_fatturato >= 1000
    $query = "UPDATE rappresentante SET percentuale_provvigione = percentuale_provvigione + 2 WHERE regione = :regione AND ultimo_fatturato >= 1000";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":regione", $regione);
    $stmt->execute();

    // Prepare the query to get the rappresentante with the new provvigione
    $query = "SELECT * FROM rappresentante WHERE regione = :regione AND ultimo_fatturato >= 1000";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":regione", $regione);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aumenta provvigione</title>
    <link rel="stylesheet" href="../style/style.css">
</head>

<body>
    <div class="mainWrapper">
        <?php if ($_SERVER['REQUEST_METHOD'] === 'POST') : ?>
            <?php
            // Execute the query and set the fetch mode
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            ?>

            <h1>Provvigione aumentata</h1>
            <p>Provvigione aumentata ai rappresentanti della regione <?= $regione ?> con ultimo fatturato maggiore o uguale a 1000€</p>

            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Cognome</th>
                        <th>Ultimo Fatturato</th>
                        <th>Regione</th>
                        <th>Provincia</th>
                        <th>Percentuale provvigione</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($stmt->fetchAll() as $rappresentante) : ?>
                        <tr>
                            <td><?= $rappresentante['id'] ?></td>
                            <td><?= $rappresentante['nome'] ?></td>
                            <td><?= $rappresentante['cognome'] ?></td>
                            <td><?= $rappresentante['ultimo_fatturato'] ?></td>
                            <td><?= $rappresentante['regione'] ?></td>
                            <td><?= $rappresentante['provincia'] ?></td>
                            <td><?= $rappresentante['percentuale_provvigione'] ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="6">Total row</td>
                        <td><?= $stmt->rowCount() ?></td>
                    </tr>
                </tfoot>
            </table>


        <?php else : ?>
            <h1>Errore 405 metodo non permesso</h1>
            <p>Accedi a questa pagina utilizzando il metodo POST</p>
            <?php
            http_response_code(405);
            ?>
        <?php endif ?>
    </div>
</body>

</html>