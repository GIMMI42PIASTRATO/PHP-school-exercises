<?php
// Dashboard view
require_once __DIR__ . "/../../utils/helper.php"
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="./public/css/index.css">
    <script src="./public/js/dashboard-index.js" defer></script>
</head>

<body>
    <nav class="verticalNavbar">
        <div class="nameContainer">
            <h1 class="h1Margin">XELO</h1>
        </div>
        <div class="verticalLinks">
            <a href="./dashboard" class="vNavLink active"><span class="charIcon">Ω</span>Home</a>
            <a href="./dashboard/search" class="vNavLink"><span class="charIcon">Œ</span>Search</a>
            <a href="./dashboard/addsinger" class="vNavLink"><span class="charIcon">Ħ</span>Add singer</a>
            <a href="./dashboard/addSong" class="vNavLink"><span class="charIcon">ß</span>Add song</a>
        </div>
        <div class="navbar-footer">
            <a href="./api/auth/logout" class="logout-button">
                <span class="charIcon">⏻</span>
                Logout
            </a>
        </div>
    </nav>

    <main class="welcome">
        <h1 class="welcome-heading">コンニチハ&nbsp;&nbsp;&nbsp;<?= sanitizeData($user["username"]) ?></h1>
        <p class="jukebox-tagline">ジュークボックス - Unlock Your Rhythm!</p>
    </main>
</body>

</html>