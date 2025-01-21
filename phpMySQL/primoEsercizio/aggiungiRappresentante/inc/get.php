<?php

declare(strict_types=1);
require_once __DIR__ . "/../../utils/helper.php"
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Aggiungi rappresentante</title>
    <link rel="stylesheet" href="../style/style.css" />
</head>

<body class="fullScreenBody">
    <div class="formContainer">
        <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
            <div class="formHeader">
                <h1>Aggiungi rappresentante</h1>
                <p>Aggiungi un rappresentante che non è presente nel database</p>
            </div>

            <div class="formBody">
                <label for="fiscalCode">Codice fiscale</label>
                <input
                    type="text"
                    id="fiscalCode"
                    name="fiscalCode"
                    placeholder="JNHDOE80A01L219X"
                    class="<?= isset($errors["fiscalCode"]) ? "error" : "" ?>"
                    value="<?= htmlspecialchars($inputs["fiscalCode"] ?? "") ?>" />
                <small><?= $errors["fiscalCode"] ?? "" ?></small>

                <label for="name">Nome</label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    placeholder="Jonh"
                    class="<?= isset($errors["name"]) ? "error" : '' ?>"
                    value="<?= htmlspecialchars($inputs['name'] ?? '') ?>" />

                <small><?= $errors["name"] ?? '' ?></small>

                <label for="surname">Cognome</label>
                <input
                    type="text"
                    id="surname"
                    name="surname"
                    placeholder="Doe"
                    class="<?= isset($errors["surname"]) ? "error" : '' ?>"
                    value="<?= htmlspecialchars($inputs['surname'] ?? '') ?>" />
                <small><?= $errors["surname"] ?? '' ?></small>

                <label for="lastRevenue">Ultimo fatturato</label>
                <input
                    type="number"
                    min="0"
                    id="lastRevenue"
                    name="lastRevenue"
                    placeholder="10000"
                    class="<?= isset($errors["lastRevenue"]) ? "error" : '' ?>"
                    value="<?= htmlspecialchars($inputs['lastRevenue'] ?? '') ?>" />
                <small><?= $errors["lastRevenue"] ?? '' ?></small>

                <label for="region">Regione</label>
                <select name="region" id="region" class="<?= isset($errors["region"]) ? "error" : '' ?>">
                    <?php foreach ($regions as $region) : ?>
                        <option value="<?= $region ?>" <?= (isset($inputs['region']) && $inputs['region'] === $region) ? 'selected' : '' ?>><?= $region ?></option>
                    <?php endforeach ?>
                </select>
                <small><?= $errors["region"] ?? '' ?></small>

                <label for="province">Provincia</label>
                <select name="province" id="province" class="<?= isset($errors["province"]) ? "error" : '' ?>">
                    <?php foreach ($provinces as $key => $value) : ?>
                        <option value="<?= $key ?>" <?= (isset($inputs['province']) && $inputs['province'] === $key) ? 'selected' : '' ?>><?= $value ?></option>
                    <?php endforeach ?>
                </select>
                <small><?= $errors["province"] ?? '' ?></small>

                <label for="commission_percentage ">Percentuale provvigione</label>
                <input
                    type="number"
                    min="0"
                    max="100"
                    id="commission_percentage"
                    name="commission_percentage"
                    placeholder="17"
                    class="<?= isset($errors["commission_percentage"]) ? "error" : '' ?>"
                    value="<?= htmlspecialchars($inputs['commission_percentage'] ?? '') ?>" />
                <small><?= $errors["commission_percentage"] ?? '' ?></small>

            </div>

            <div class="formFooter">
                <button type="submit">Aggiungi</button>

                <?php if ($dbError) : ?>
                    <span class="dbError">Si è verificato un errore</span>
                <?php endif ?>

                <?php if ($dbSucces) : ?>
                    <span class="dbSuccess">Rappresentante inserito correttamente</span>
                <?php endif ?>
            </div>
        </form>
    </div>
</body>

</html>