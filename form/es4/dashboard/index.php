<?php

declare(strict_types=1);
session_start();

if (!isset($_SESSION["user"])) {
    header("Location: ../index.php");
    exit;
}

$user = $_SESSION["user"];
$checkboxData = $_SESSION["checkboxData"];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard di <?= $user["username"] ?></title>
    <link rel="stylesheet" href="./style.css">
</head>

<body>
    <h1>Benvenuto <?= $user["username"] ?></h1>
    <h2>Ecco i tuoi dati</h2>

    <table border="1">
        <thead>
            <tr>
                <th>Username</th>
                <th>Password</th>
                <th>Checkbox Data</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?= htmlspecialchars($user["username"]) ?></td>
                <td><?= htmlspecialchars($user["password"]) ?></td>
                <td>
                    <ul>
                        <?php foreach ($checkboxData as $data): ?>
                            <li><?= htmlspecialchars($data) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </td>
            </tr>
        </tbody>
    </table>

    <a href="../api/disconnect.php">Logout</a>
</body>

</html>