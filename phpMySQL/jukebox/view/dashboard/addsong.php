<?php
// Dashboard view
require_once __DIR__ . "/../../utils/helper.php";
require_once __DIR__ . "/../../models/SingerModel.php";
require_once __DIR__ . "/../../models/GenreModel.php";

// Get all singers for the dropdown
$singers = SingerModel::getAllSingers();
// Get all genres for the dropdown
$genres = GenreModel::getAllGenres();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Song - Dashboard</title>
    <link rel="stylesheet" href="../public/css/index.css">
    <script src="../public/js/addsong-index.js" defer></script>
</head>

<body>
    <nav class="verticalNavbar">
        <div class="nameContainer">
            <h1 class="h1Margin">XELO</h1>
        </div>
        <div class="verticalLinks">
            <a href="../dashboard" class="vNavLink"><span class="charIcon">Ω</span>Home</a>
            <a href="./search" class="vNavLink"><span class="charIcon">Œ</span>Search</a>
            <a href="./addsinger" class="vNavLink"><span class="charIcon">Ħ</span>Add singer</a>
            <a href="./addSong" class="vNavLink active"><span class="charIcon">ß</span>Add song</a>
        </div>
        <div class="navbar-footer">
            <a href="../api/auth/logout" class="logout-button">
                <span class="charIcon">⏻</span>
                Logout
            </a>
        </div>
    </nav>

    <main class="mainWrapper">
        <form action="../api/songs/create" method="post" enctype="multipart/form-data">
            <section class="largeCard">
                <div class="cover-upload-container">
                    <label for="coverUpload">
                        <img id="previewCover" src="../public/image/img2.png" alt="Upload Cover" />
                    </label>
                    <input type="file" id="coverUpload" name="song_cover" accept="image/*" />
                </div>

                <div class="songNameContainer">
                    <p class="songtag">Song</p>
                    <input type="text" id="songName" name="name" placeholder="Enter song name" required>

                    <div class="song-details">
                        <div class="form-group">
                            <label for="releaseDate">Release Date</label>
                            <input type="date" id="releaseDate" name="release_date" required>
                        </div>

                        <div class="form-group">
                            <label for="duration">Duration (seconds)</label>
                            <input type="number" id="duration" name="duration" min="1" required>
                        </div>

                        <div class="form-group">
                            <label for="genre">Genre</label>
                            <select id="genre" name="genre" required>
                                <option value="">Select a genre</option>
                                <?php foreach ($genres as $genre): ?>
                                    <option value="<?= htmlspecialchars($genre['id']) ?>"><?= htmlspecialchars($genre['nome']) ?></option>
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
                        <?php foreach ($singers as $singer): ?>
                            <div class="singer-option">
                                <input type="checkbox" id="singer_<?= htmlspecialchars($singer['id']) ?>"
                                    name="singers[]" value="<?= htmlspecialchars($singer['id']) ?>">
                                <label for="singer_<?= htmlspecialchars($singer['id']) ?>"><?= htmlspecialchars($singer['nickname']) ?></label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="audio-upload">
                    <label for="audioUpload">Upload Audio File</label>
                    <input type="file" id="audioUpload" name="audio_file" accept="audio/*">
                    <span id="selectedAudioFile">No file selected</span>
                </div>

                <div class="submit-container">
                    <button type="submit" class="submit-button">Add Song</button>
                </div>
            </div>
        </form>
    </main>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/color-thief/2.3.0/color-thief.umd.js"></script>
</body>

</html>