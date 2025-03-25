<?php

declare(strict_types=1);
session_start();
?>


<nav>
    <h1 class="name">XELO</h1>
    <?php if (isset($_SESSION["user_id"])) : ?>
        <button>Sei loggato bro</button>
    <?php else : ?>
        <button>Sign In</button>
        <button>Sign Up</button>
    <?php endif ?>
    <div>

    </div>
</nav>