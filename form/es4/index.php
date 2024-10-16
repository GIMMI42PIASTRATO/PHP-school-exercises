<?php

declare(strict_types=1);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form di Scelta</title>
    <link rel="stylesheet" href="./style.css">
</head>

<body>
    <?php
    session_start();

    if (isset($_SESSION["user"])) {
        header("Location: ./dashboard/index.php");
        exit;
    }

    $checkboxsData = [
        "html" => "HTML",
        "php" => "PHP",
        "asp" => "ASP",
        "oggettiMultimediali" => "Oggetti multimediali"
    ];

    $formData = $_SESSION["formData"] ?? [];
    $errors = $_SESSION["errors"] ?? [];

    $usernameInput = $formData["username"] ?? "";
    $passwordInput = $formData["password"] ?? "";

    unset($_SESSION["formData"]);
    unset($_SESSION["errors"]);
    ?>

    <div class="container">
        <div class="header">
            <h1>
                Seleziona scelta
            </h1>
            <p>Inserisci un nome utente e una password e poi seleziona gli argomenti che vuoi approfondire</p>
        </div>
        <form action="./api/route.php" method="post">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" placeholder="Jhon Doe" value="<?= $usernameInput ?>" required>
            <?php if (isset($errors["username"])) : ?>
                <p class="error"><?= $errors["username"] ?></p>
            <?php endif ?>

            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="********" value="<?= $passwordInput ?>" required>
            <?php if (isset($errors["password"])) : ?>
                <p class="error"><?= $errors["password"] ?></p>
            <?php endif ?>

            <div class="line"></div>

            <h4>Quali argomenti desideri approfondire</h4>
            <div class="checkboxsContainer">
                <?php foreach ($checkboxsData as $key => $value) : ?>

                    <label class="custom-checkbox" for="<?= $key ?>">
                        <input type="checkbox" name="<?= $key ?>" id="<?= $key ?>"
                            <?php
                            if (isset($formData[$key])) {
                                echo "checked";
                            }
                            ?>>
                        <span class="checkmark">

                            <svg class="checkmark-icon" width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.4669 3.72684C11.7558 3.91574 11.8369 4.30308 11.648 4.59198L7.39799 11.092C7.29783 11.2452 7.13556 11.3467 6.95402 11.3699C6.77247 11.3931 6.58989 11.3355 6.45446 11.2124L3.70446 8.71241C3.44905 8.48022 3.43023 8.08494 3.66242 7.82953C3.89461 7.57412 4.28989 7.55529 4.5453 7.78749L6.75292 9.79441L10.6018 3.90792C10.7907 3.61902 11.178 3.53795 11.4669 3.72684Z" fill="currentColor" fill-rule="evenodd" clip-rule="evenodd"></path>
                            </svg>

                        </span>
                        <?= $value ?>
                    </label>

                <?php endforeach; ?>
            </div>

            <button type="submit">Aderisci</button>
        </form>
    </div>
</body>

</html>