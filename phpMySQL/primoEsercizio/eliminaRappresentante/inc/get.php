<?php

declare(strict_types=1);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="../style/style.css" />
</head>

<body class="fullScreenBody">
    <div class="formContainer">
        <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
            <div class="formHeader">
                <h1>Elimina rappresentante</h1>
                <p>Elimina un rappresentante dal database utilizzando il codice fiscale</p>
            </div>

            <div class="formBody">
                <label for="fiscalCode">Nome</label>
                <input
                    type="text"
                    id="fiscalCode"
                    name="fiscalCode"
                    placeholder="JNHDOE80A01L219X"
                    class="<?= isset($errors["fiscalCode"]) ? "error" : '' ?>"
                    value="<?= htmlspecialchars($inputs['fiscalCode'] ?? '') ?>" />

                <small><?= $errors["fiscalCode"] ?? '' ?></small>
            </div>

            <div class="formFooter">
                <button type="submit">Elimina</button>

                <?php if ($dbError) : ?>
                    <span class="dbError">Si è verificato un errore</span>
                <?php endif ?>

                <?php if ($dbSucces) : ?>
                    <span class="dbSuccess">Rappresentante eliminato correttamente</span>
                <?php endif ?>
            </div>
        </form>
    </div>
</body>

</html>