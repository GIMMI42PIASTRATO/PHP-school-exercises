<?php

declare(strict_types=1);
include_once "../db/db.php";

function sanitizeData(string $value): string
{
    return htmlspecialchars(stripslashes(trim($value)));
}



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fatturatoMin = (float) sanitizeData($_POST['fatturatoMin']);
    $fatturatoMax = (float) sanitizeData($_POST['fatturatoMax']);

    $query = "SELECT * FROM rappresentante WHERE ultimo_fatturato BETWEEN $fatturatoMin AND $fatturatoMax";
    $stmt = $db->prepare($query);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rappresentanti risultati</title>
    <link rel="stylesheet" href="../style/style.css">
</head>

<body>
    <div class="mainWrapper">
        <?php if ($_SERVER['REQUEST_METHOD'] === 'POST') : ?>
            <?php
            $stmt->execute();
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            ?>

            <h1>Risultati</h1>
            <p>Rappresentati con un fatturato compreso tra <?= $fatturatoMin ?> e <?= $fatturatoMax ?></p>

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