<?php
// Edit Song view
require_once __DIR__ . "/../../utils/helper.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Song - <?= htmlspecialchars($song['nome']) ?></title>
    <link rel="stylesheet" href="../../public/css/index.css">
    <script src="../../public/js/editsong-index.js" defer></script>
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
        <form action="../../api/songs/update/<?= htmlspecialchars($song['id']) ?>" method="post" enctype="multipart/form-data">
            <section class="largeCard">
                <div class="cover-upload-container">
                    <label for="coverUpload">
                        <?php if ($song['copertina']): ?>
                            <img id="previewCover" src="../../public/<?= htmlspecialchars($song['copertina']) ?>" alt="<?= htmlspecialchars($song['nome']) ?>" />
                        <?php else: ?>
                            <img id="previewCover" src="../../public/image/img2.png" alt="Default cover image" />
                        <?php endif; ?>
                    </label>
                    <input type="file" id="coverUpload" name="song_cover" accept="image/*" />
                </div>

                <div class="songNameContainer">
                    <p class="songtag">Song</p>
                    <input type="text" id="songName" name="name" placeholder="Enter song name" value="<?= htmlspecialchars($song['nome']) ?>" required>

                    <div class="song-details">
                        <div class="form-group">
                            <label for="releaseDate">Release Date</label>
                            <input type="date" id="releaseDate" name="release_date" value="<?= htmlspecialchars(date('Y-m-d', strtotime($song['data_rilascio']))) ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="duration">Duration (seconds)</label>
                            <input type="number" id="duration" name="duration" min="1" value="<?= htmlspecialchars($song['durata']) ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="genre">Genre</label>
                            <select id="genre" name="genre" required>
                                <option value="">Select a genre</option>
                                <?php foreach ($genres as $genre): ?>
                                    <option value="<?= htmlspecialchars($genre['id']) ?>" <?= $song['genere'] == $genre['id'] ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($genre['nome']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
            </section>

            <h2>Song Details</h2>
            <div class="form-column">
                <div class="singer-selection">
                    <label for="singers">Select Singer(s)</label>
                    <div class="singer-checkboxes">
                        <?php
                        // Create an array of singer IDs for this song for easier checking
                        $songSingerIds = array_map(function ($singer) {
                            return $singer['id'];
                        }, $song['singers'] ?? []);
                        ?>
                        <?php foreach ($singers as $singer): ?>
                            <div class="singer-option">
                                <input type="checkbox" id="singer_<?= htmlspecialchars($singer['id']) ?>"
                                    name="singers[]" value="<?= htmlspecialchars($singer['id']) ?>"
                                    <?= in_array($singer['id'], $songSingerIds) ? 'checked' : '' ?>>
                                <label for="singer_<?= htmlspecialchars($singer['id']) ?>"><?= htmlspecialchars($singer['nickname']) ?></label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="audio-upload">
                    <label for="audioUpload">Upload New Audio File (optional)</label>
                    <input type="file" id="audioUpload" name="audio_file" accept="audio/*">
                    <span id="selectedAudioFile">Current file: <?= basename($song['percorso_audio'] ?? 'None') ?></span>
                </div>

                <div class="submit-container">
                    <button type="submit" class="submit-button">Update Song</button>
                </div>
            </div>
        </form>
    </main>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/color-thief/2.3.0/color-thief.umd.js"></script>
</body>

</html>