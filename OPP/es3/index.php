<?php

declare(strict_types=1);
require_once "./classes/RandomImageSelector.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OPP Random Image</title>
    <style>
        body {
            margin: 0;
            box-sizing: border-box;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        img {
            height: 384px;
            width: auto;
            aspect-ratio: 9/16;
            object-fit: cover;
        }
    </style>
</head>

<body>
    <div>
        <img alt="immagine" src="./images/<?= RandomImageSelector::selectRandomImage(1, 6) ?>" />
    </div>
</body>

</html>