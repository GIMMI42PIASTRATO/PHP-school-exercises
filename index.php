<?php

declare(strict_types=1);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vittorio Bussano</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script>
    <link rel="icon" type="image/x-icon" href="./favicon.svg">
</head>

<body>
    <div>
        <header>
            <h1>Vittorio Bussano</h1>
            <div class="nav">
                <a href="https://vittoriobussano.vercel.app/" target="_blank">REAL PORTFOLIO</a>
                <a href="mailto: vittoriobussano@gmail.com">CONTACT</a>
                <a href="https://github.com/GIMMI42PIASTRATO" target="_blank">GITHUB</a>
            </div>
        </header>
        <section class="hero">
            <div>
                <p><span class="capital">V</span>ITTORIO <span class="capital">B</span>USSANO</p>
            </div>
            <div>
                <p>INDIPENDENT FRONT END</p>
            </div>
            <div>
                <p><span class="pixelated">☼DEVELOPER☀</span></p>
            </div>
            <div>
                <p>CURRENTLY<span class="capital">@</span><span class="pixelated">&lt;INSERTCOMPANY/&gt;</span></p>
            </div>
            <div>
                <p>FOLIO<span class="pixelated">©</span>2024<span class="pixelated">⚗✨</span></p>
            </div>
        </section>
        <div class="table">
            <div class="tableHeader">
                <p>Project</p>
                <p>Subject</p>
                <p>Date</p>
            </div>

            <?php
            $projects = json_decode(file_get_contents('./projects.json'), true);

            foreach ($projects as $project) {
                echo "<div class='rowDividier'></div>";
                echo "<div class='tableRow'>";
                echo "<p>" . $project['projectName'] . "</p>";
                echo "<p>" . $project['subject'] . "</p>";
                echo "<p>" . date('j M Y', strtotime($project['date'])) . "</p>";
                echo "<div class='hoverBackground'></div>";
                echo "</div>";
            }

            ?>
        </div>
    </div>
</body>

</html>