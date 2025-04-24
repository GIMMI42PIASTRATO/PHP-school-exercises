<?php
// Dashboard view
require_once __DIR__ . "/../../utils/helper.php"
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Singer Details - <?= htmlspecialchars($singer['nickname']) ?></title>
    <link rel="stylesheet" href="../../public/css/index.css">
    <script src="../../public/js/singer-details.js" defer></script>
</head>

<body>
    <nav class="verticalNavbar">
        <div class="nameContainer">
            <h1 class="h1Margin">XELO</h1>
        </div>
        <div class="verticalLinks">
            <a href="../../dashboard" class="vNavLink"><span class="charIcon">Ω</span>Home</a>
            <a href="../search" class="vNavLink"><span class="charIcon">Œ</span>Search</a>
            <a href="../addsinger" class="vNavLink"><span class="charIcon">Ħ</span>Add singer</a>
            <a href="../addSong" class="vNavLink"><span class="charIcon">ß</span>Add song</a>
        </div>
        <div class="navbar-footer">
            <a href="../../api/auth/logout" class="logout-button">
                <span class="charIcon">⏻</span>
                Logout
            </a>
        </div>
    </nav>

    <main class="mainWrapper">
        <section class="largeCard" id="singerProfile">
            <div class="image-upload-container">
                <?php if ($singer['immagine_profilo']): ?>
                    <img id="singerImage" src="../../public/<?= htmlspecialchars($singer['immagine_profilo']) ?>" alt="<?= htmlspecialchars($singer['nickname']) ?>" />
                <?php else: ?>
                    <img id="singerImage" src="../../public/image/img1.png" alt="Default singer image" />
                <?php endif; ?>
            </div>

            <div class="singerNameContainer">
                <p class="singertag">Singer</p>
                <h1 id="singerName"><?= htmlspecialchars($singer['nickname']) ?></h1>
            </div>
        </section>

        <section class="singer-details">
            <h2>Biography</h2>
            <p class="biography"><?= nl2br(htmlspecialchars($singer['biografia'] ?? 'No biography available')) ?></p>

            <div class="status">
                Status: <span class="<?= $singer['attivo'] ? 'active' : 'inactive' ?>"><?= $singer['attivo'] ? 'Active' : 'Inactive' ?></span>
            </div>
        </section>

        <?php if (!empty($songs)): ?>
            <section class="singer-songs">
                <h2>Discography</h2>
                <div class="song-cards-grid">
                    <?php foreach ($songs as $song): ?>
                        <div class="song-card" onclick="location.href='../song/<?= htmlspecialchars($song['id']) ?>'">
                            <div class="song-card-cover">
                                <?php if ($song['copertina']): ?>
                                    <img src="../../public/<?= htmlspecialchars($song['copertina']) ?>" alt="<?= htmlspecialchars($song['nome']) ?>" />
                                <?php else: ?>
                                    <img src="../../public/image/img2.png" alt="Default cover image" />
                                <?php endif; ?>
                                <div class="song-play-overlay">
                                    <span class="play-icon">▶</span>
                                </div>
                            </div>
                            <div class="song-card-body">
                                <h3><?= htmlspecialchars($song['nome']) ?></h3>
                                <div class="song-card-details">
                                    <span class="song-genre"><?= htmlspecialchars($song['nome_genere']) ?></span>
                                    <span class="song-year"><?= date('Y', strtotime($song['data_rilascio'])) ?></span>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>
        <?php else: ?>
            <section class="singer-songs">
                <h2>Discography</h2>
                <p class="no-songs-message">This artist doesn't have any songs yet.</p>
            </section>
        <?php endif; ?>
    </main>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/color-thief/2.3.0/color-thief.umd.js"></script>
</body>

</html>