<?php

declare(strict_types=1);

require_once __DIR__ . "/../../db/db.php";

$query = "SELECT * FROM rappresentante;";

$stmt = $db->prepare($query);
$stmt->execute();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizza rappresentanti</title>
    <link rel="stylesheet" href="../style/style.css" />
</head>

<body>
    <div class="mainWrapper">
        <?php if ($stmt->rowCount() === 0) : ?>
            <h1>Nessun risultato</h1>
            <p>Non ci sono rappresentanti con ultimo fatturato maggiore o uguale a 1000€ nella regione <?= $regione ?></p>

        <?php else : ?>
            <h1>Visualizza rappresentanti</h1>
            <p>Tutti i rappresentanti presenti all'interno del database</p>

            <table>
                <thead>
                    <tr>
                        <th>Codice fiscale</th>
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
                            <td><?= $rappresentante['codice_fiscale'] ?></td>
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

        <?php endif ?>
    </div>
</body>

</html>