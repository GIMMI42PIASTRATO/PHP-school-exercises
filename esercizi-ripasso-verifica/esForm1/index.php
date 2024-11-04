<?php

declare(strict_types=1);

function sanitizeUserInput(string $userData): string
{
    return htmlspecialchars(stripslashes(trim($userData)));
}

// declare variables and assign a default value
$username = $password = $country = $acceptTerm = $acceptNewsletter = "";
$errorMessage = sanitizeUserInput($_GET["errorMessage"] ?? "");
$usernameError = sanitizeUserInput($_GET["usernameError"] ?? "");
$passwordError = sanitizeUserInput($_GET["passwordError"] ?? "");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    //assign the user data
    $username = sanitizeUserInput($_POST["username"]);
    $password = sanitizeUserInput($_POST["password"]);
    $country = sanitizeUserInput($_POST["country"]);
    $acceptTerm = isset($_POST["acceptTermAndCondition"]) ? sanitizeUserInput($_POST["acceptTermAndCondition"]) : "";
    $acceptNewsletter = isset($_POST["acceptNewletter"]) ? sanitizeUserInput($_POST["acceptNewletter"]) : "";

    // load the json file
    $jsonContent = file_get_contents("./data/users.json");

    if ($jsonContent === false) {
        header("Location: ./index.php?errorMessage=Internal server error");
        exit;
    }

    // decode the json file
    $users = json_decode($jsonContent, true);

    if ($users === null) {
        header("Location: ./index.php?errorMessage=Internal server error");
        exit;
    }

    // check if the usernaame arleady exist
    foreach ($users as $user) {
        if ($user["userName"] === $username) {
            header("Location: ./index.php?usernameError=Username arleady in use");
            exit;
        }
    }

    if (strlen($password) < 8) {
        header("Location: ./index.php?passwordError=Password must be at least 8 character long");
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <main class="container">
        <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">

            <div class="header">
                <h1>
                    Login THICK
                </h1>
                <p>Inserisci ogni cosa che viene richiesta su questo form</p>
            </div>

            <label for="username">Username</label>
            <input type="text" name="username" id="username" value="<?= $username ?>" required>
            <p><?= $usernameError ?></p>

            <label for="password">Password</label>
            <input type="password" name="password" id="password" value="<?= $password ?>" required>
            <p><?= $passwordError ?></p>

            <label for="country">Country</label>
            <select name="country" id="country" required>
                <option value="italy">Italy</option>
            </select>

            <label for="acceptTermAndCondition">
                <input type="checkbox" name="acceptTermAndCondition" id="acceptTermAndCondition" value="<?= $acceptTerm ?>" required>
                Accept terms and conditions
            </label>

            <label for="acceptNewletter">
                <input type="checkbox" name="acceptNewletter" id="acceptNewletter" value="<?= $acceptNewsletter ?>">
                Accept to recive news about the product and events

            </label>

            <button type="submit">Submit</button>
            <p><?= $errorMessage ?></p>
        </form>
    </main>

    <?= $acceptNewsletter ?>
</body>

</html>