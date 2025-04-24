<?php
// Dashboard view
require_once __DIR__ . "/../../utils/helper.php";

// Helper function to format duration
function formatDuration($seconds)
{
    $minutes = floor($seconds / 60);
    $remainingSeconds = $seconds % 60;
    return sprintf("%d:%02d", $minutes, $remainingSeconds);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Song Details - <?= htmlspecialchars($song['nome']) ?></title>
    <link rel="stylesheet" href="../../public/css/index.css">
    <script src="../../public/js/song-details.js" defer></script>
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
            <a href="../addsong" class="vNavLink"><span class="charIcon">ß</span>Add song</a>
        </div>
        <div class="navbar-footer">
            <a href="../../api/auth/logout" class="logout-button">
                <span class="charIcon">⏻</span>
                Logout
            </a>
        </div>
    </nav>

    <main class="mainWrapper">
        <section class="largeCard" id="songProfile">
            <div class="cover-upload-container">
                <?php if ($song['copertina']): ?>
                    <img id="songCover" src="../../public/<?= htmlspecialchars($song['copertina']) ?>" alt="<?= htmlspecialchars($song['nome']) ?>" />
                <?php else: ?>
                    <img id="songCover" src="../../public/image/img2.png" alt="Default cover image" />
                <?php endif; ?>
            </div>

            <div class="songNameContainer">
                <p class="songtag">Song</p>
                <h1 id="songTitle"><?= htmlspecialchars($song['nome']) ?></h1>

                <div class="song-metadata">
                    <div class="metadata-item">
                        <span class="metadata-label">Genre</span>
                        <span class="metadata-value"><?= htmlspecialchars($song['nome_genere']) ?></span>
                    </div>

                    <div class="metadata-item">
                        <span class="metadata-label">Release Date</span>
                        <span class="metadata-value"><?= date('F j, Y', strtotime($song['data_rilascio'])) ?></span>
                    </div>

                    <div class="metadata-item">
                        <span class="metadata-label">Duration</span>
                        <span class="metadata-value"><?= formatDuration($song['durata']) ?></span>
                    </div>
                </div>
            </div>
        </section>

        <section class="song-details">
            <?php if (!empty($song['singers'])): ?>
                <div class="singer-list">
                    <h3>Performed by</h3>
                    <ul>
                        <?php foreach ($song['singers'] as $singer): ?>
                            <li>
                                <a href="../../dashboard/singer/<?= htmlspecialchars($singer['id']) ?>">
                                    <?= htmlspecialchars($singer['nickname']) ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <div class="audio-player">
                <h3>Listen</h3>
                <audio controls>
                    <source src="../../public/<?= htmlspecialchars($song['percorso_audio']) ?>" type="audio/mpeg">
                    Your browser does not support the audio element.
                </audio>
            </div>
        </section>
    </main>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/color-thief/2.3.0/color-thief.umd.js"></script>
</body>

</html>