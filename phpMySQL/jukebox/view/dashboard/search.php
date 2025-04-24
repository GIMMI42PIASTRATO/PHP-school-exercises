<?php
// filepath: /opt/homebrew/var/www/vittoriobussano/phpMySQL/jukebox/view/dashboard/search.php
// Search view
require_once __DIR__ . "/../../utils/helper.php";
require_once __DIR__ . "/../../models/SingerModel.php";
require_once __DIR__ . "/../../models/SongModel.php";

// Get all singers and songs
$singers = SingerModel::getAllSingers();
$songs = SongModel::getAllSongs();

// Handle search query if present
$searchQuery = $_GET['q'] ?? '';
if (!empty($searchQuery)) {
    // Filter singers and songs based on search query
    $singers = array_filter($singers, function ($singer) use ($searchQuery) {
        return stripos($singer['nickname'], $searchQuery) !== false;
    });

    $songs = array_filter($songs, function ($song) use ($searchQuery) {
        return stripos($song['nome'], $searchQuery) !== false;
    });
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search - Dashboard</title>
    <link rel="stylesheet" href="../public/css/index.css">
    <script src="../public/js/search.js" defer></script>
</head>

<body>
    <nav class="verticalNavbar">
        <div class="nameContainer">
            <h1 class="h1Margin">XELO</h1>
        </div>
        <div class="verticalLinks">
            <a href="../dashboard" class="vNavLink"><span class="charIcon">Ω</span>Home</a>
            <a href="./search" class="vNavLink active"><span class="charIcon">Œ</span>Search</a>
            <a href="./addsinger" class="vNavLink"><span class="charIcon">Ħ</span>Add singer</a>
            <a href="./addSong" class="vNavLink"><span class="charIcon">ß</span>Add song</a>
        </div>
        <div class="navbar-footer">
            <a href="../api/auth/logout" class="logout-button">
                <span class="charIcon">⏻</span>
                Logout
            </a>
        </div>
    </nav>

    <main class="mainWrapper">
        <h1>Search</h1>

        <div class="search-container">
            <form action="./search" method="GET" class="search-form">
                <input type="text" name="q" placeholder="Search singers or songs..." value="<?= htmlspecialchars($searchQuery) ?>">
                <button type="submit">Search</button>
            </form>
        </div>

        <div class="search-results">
            <div class="column singers-column">
                <h2>Singers</h2>
                <div class="cards-container">
                    <?php if (empty($singers)): ?>
                        <p class="no-results">No singers found</p>
                    <?php else: ?>
                        <?php foreach ($singers as $singer): ?>
                            <div class="card singer-card" data-id="<?= htmlspecialchars($singer['id']) ?>">
                                <div class="card-content" onclick="location.href='./singer/<?= htmlspecialchars($singer['id']) ?>'">
                                    <div class="card-image singer-image">
                                        <?php if ($singer['immagine_profilo']): ?>
                                            <img src="../public/<?= htmlspecialchars($singer['immagine_profilo']) ?>" alt="<?= htmlspecialchars($singer['nickname']) ?>">
                                        <?php else: ?>
                                            <img src="../public/image/img1.png" alt="Default singer image">
                                        <?php endif; ?>
                                    </div>
                                    <div class="card-info">
                                        <h3><?= htmlspecialchars($singer['nickname']) ?></h3>
                                        <span class="status-badge <?= $singer['attivo'] ? 'active' : 'inactive' ?>"><?= $singer['attivo'] ? 'Active' : 'Inactive' ?></span>
                                    </div>
                                </div>
                                <button class="delete-button" data-type="singer" data-id="<?= htmlspecialchars($singer['id']) ?>">Delete</button>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>

            <div class="column songs-column">
                <h2>Songs</h2>
                <div class="cards-container">
                    <?php if (empty($songs)): ?>
                        <p class="no-results">No songs found</p>
                    <?php else: ?>
                        <?php foreach ($songs as $song): ?>
                            <div class="card song-card" data-id="<?= htmlspecialchars($song['id']) ?>">
                                <div class="card-content" onclick="location.href='./song/<?= htmlspecialchars($song['id']) ?>'">
                                    <div class="card-image song-image">
                                        <?php if ($song['copertina']): ?>
                                            <img src="../public/<?= htmlspecialchars($song['copertina']) ?>" alt="<?= htmlspecialchars($song['nome']) ?>">
                                        <?php else: ?>
                                            <img src="../public/image/img2.png" alt="Default cover image">
                                        <?php endif; ?>
                                    </div>
                                    <div class="card-info">
                                        <h3><?= htmlspecialchars($song['nome']) ?></h3>
                                        <span class="genre-badge"><?= htmlspecialchars($song['nome_genere']) ?></span>
                                    </div>
                                </div>
                                <button class="delete-button" data-type="song" data-id="<?= htmlspecialchars($song['id']) ?>">Delete</button>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div id="confirmation-modal" class="modal">
            <div class="modal-content">
                <h2>Confirm Deletion</h2>
                <p>Are you sure you want to delete this item? This action cannot be undone.</p>
                <div class="modal-buttons">
                    <button id="confirm-delete" class="danger-button">Delete</button>
                    <button id="cancel-delete" class="cancel-button">Cancel</button>
                </div>
            </div>
        </div>
    </main>
</body>

</html>