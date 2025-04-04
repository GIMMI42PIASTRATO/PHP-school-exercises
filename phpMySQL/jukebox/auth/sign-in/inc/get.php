<?php

declare(strict_types=1);
require_once __DIR__ . "/../../../utils/helper.php"
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Aggiungi rappresentante</title>
    <link rel="stylesheet" href="../../style/index.css" />
    <script src="./submitHandler.js" defer></script>
</head>

<body class="fullScreenBody">
    <div class="formContainer">
        <form>
            <div class="formHeader">
                <h1>Sign In</h1>
                <p>Welcome back, we have been waiting you!</p>
            </div>

            <div class="formBody">
                <label for="email">Codice fiscale</label>
                <input
                    type="text"
                    id="email"
                    name="email"
                    placeholder="jon@doe.com" />
                <small class="emailError"></small>

                <label for="name">Nome</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="********" />

                <small class="passwordError"></small>

            </div>

            <div class="formFooter">
                <button id="submit" type="submit">Log In</button>
                <span class="result"></span>
            </div>
        </form>
    </div>
</body>

</html>