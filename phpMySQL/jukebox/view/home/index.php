<?php
$isAuthenticated = isset($_SESSION["user_id"]);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>XELO - Your Music, Your Way</title>
    <link rel="stylesheet" href="./public/css/home.css">
</head>

<body>
    <div class="animated-background">
        <div class="wave wave-1"></div>
        <div class="wave wave-2"></div>
        <div class="wave wave-3"></div>
        <div class="wave wave-4"></div>
        <div class="wave wave-5"></div>
    </div>

    <header>
        <div class="logo">XELO</div>
        <nav>
            <?php if ($isAuthenticated): ?>
                <a href="./dashboard" class="btn btn-secondary">Dashboard</a>
            <?php else: ?>
                <a href="./auth/sign-in" class="btn btn-text">Sign In</a>
                <a href="./auth/sign-up" class="btn btn-primary">Sign Up</a>
            <?php endif; ?>
        </nav>
    </header>

    <main>
        <section class="hero">
            <h1>Your Music, Your Way</h1>
            <p>Revolutionize your music experience with Xelo. Unlimited songs, seamless control at your fingertips.</p>
            <?php if (!$isAuthenticated): ?>
                <a href="./auth/sign-up" class="btn btn-cta">Start free trial</a>
            <?php else: ?>
                <a href="./dashboard" class="btn btn-cta">Go to Dashboard</a>
            <?php endif; ?>
        </section>
    </main>

    <script src="./public/js/home.js"></script>
</body>

</html>