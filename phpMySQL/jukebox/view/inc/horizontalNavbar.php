<nav>
    <h1 class="name">XELO</h1>
    <?php if ($isAuthenticated) : ?>
        <a href="./dashboard">Dashboard</a>
    <?php else : ?>
        <a href="./auth/sign-in">Sign In</a>
        <a href="./auth/sign-up">Sign Up</a>
    <?php endif ?>
    <div>

    </div>
</nav>