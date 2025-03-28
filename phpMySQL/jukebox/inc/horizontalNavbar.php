<?php

declare(strict_types=1);
session_start();
?>


<nav>
    <h1 class="name">XELO</h1>
    <?php if (isset($_SESSION["user_id"])) : ?>
        <button>Sei loggato bro</button>
    <?php else : ?>
        <a href="./auth/sign-in/index.php">Sign In</a>
        <a href="./auth/sign-up/index.php">Sign Up</a>
    <?php endif ?>
    <div>

    </div>
</nav>