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
    <link rel="stylesheet" href="../public/css/index.css">
    <script src="../public/js/addsinger-index.js" defer></script>
</head>

<body>
    <nav class="verticalNavbar">
        <div class="nameContainer">
            <h1 class="h1Margin">XELO</h1>
        </div>
        <div class="verticalLinks">
            <a href="../dashboard" class="vNavLink"><span class="charIcon">Ω</span>Home</a>
            <a href="./search" class="vNavLink"><span class="charIcon">Œ</span>Search</a>
            <a href="./addsinger" class="vNavLink active"><span class="charIcon">Ħ</span>Add singer</a>
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
        <form action="../api/singers/create" method="post" enctype="multipart/form-data">
            <section class="largeCard">
                <div class="image-upload-container">
                    <label for="imageUpload">
                        <img id="previewImage" src="../public/image/img1.png" alt="Upload Avatar" />
                    </label>
                    <input type="file" id="imageUpload" name="singer_image" accept="image/*" />
                </div>

                <div class="singerNameContainer">
                    <p class="singertag">Singer</p>
                    <input type="text" id="artistName" name="nickname" placeholder="Enter singer name">
                </div>
            </section>
            <h2>Singer info</h2>
            <div class="form-column">
                <textarea name="biography" id="singerBio" placeholder="Enter singer biography here..."></textarea>

                <div class="checkbox-container">
                    <input type="checkbox" id="active" name="active" checked>
                    <label for="active">Active</label>
                </div>

                <div class="submit-container">
                    <button type="submit" class="submit-button">Add Singer</button>
                </div>
            </div>
        </form>
    </main>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/color-thief/2.3.0/color-thief.umd.js"></script>
</body>

</html>