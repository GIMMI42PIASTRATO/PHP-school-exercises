<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Piramide con Do While loop</title>
    <link rel="stylesheet" href="./style.css">
</head>

<body>
    <h1>Piramide con Do While loop</h1>
    <h2>Base: <?php echo $n = 3; ?></h2>

    <div>
        <?php
        $i = 1;
        do {
            echo "<h1>";

            $j = 1;
            while ($j <= $i) {
                echo "*";

                $j++;
            }

            echo "</h1>";

            $i++;
        } while ($i <= $n);
        ?>
    </div>

    <div class="link-container">
        <a href="./for-piramide.php">Piramide For Loop</a>
        <a href="./while-piramide.php">Piramide While Loop</a>
    </div>
</body>

</html>