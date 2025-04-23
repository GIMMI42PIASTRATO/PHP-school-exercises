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
    <header>
        <nav>
            <div class="navLeft">
                <span>JUKEBOX</span>
                <span>Dashboard</span>
            </div>
            <div>
                <span>Welcome, <?= sanitizeData($user['username']) ?></span>

            </div>
        </nav>
    </header>

    <div class="mainWrapper">
        <h1>Dashboard</h1>
        <p>Welcome to your dashboard!</p>
        <!-- Dashboard content here -->
    </div>
</body>

</html>