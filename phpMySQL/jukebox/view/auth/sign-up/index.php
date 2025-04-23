<?php

declare(strict_types=1);
require_once __DIR__ . "/../../../utils/helper.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Aggiungi rappresentante</title>
    <link rel="stylesheet" href="../public/css/index.css" />
    <script src="../public/js/auth-register.js" defer></script>
</head>

<body class="fullScreenBody">
    <div class="formContainer">
        <form>
            <div class="formHeader">
                <h1>Sign Up</h1>
                <p>Welcome, create a new account!</p>
            </div>

            <div class="formBody">
                <label for="username">Username</label>
                <input
                    type="text"
                    id="username"
                    name="username"
                    placeholder="Jhon Doe" />
                <small class="usernameError"></small>

                <label for="email">Email</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    placeholder="jon@doe.com" />
                <small class="emailError"></small>

                <label for="password">Password</label>
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