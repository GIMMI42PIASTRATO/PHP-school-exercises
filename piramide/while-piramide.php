<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Piramide con While loop</title>
    <link rel="stylesheet" href="./style.css">
</head>

<body>
    <h1>Piramide con While loop</h1>
    <h2>Base: <?php echo $n = 5; ?></h2>

    <div>
        <?php
        $i = 1;
        while ($i <= $n) {
            echo "<h1>";

            $j = 1;
            while ($j <= $i) {
                echo "*";

                $j++;
            }

            echo "</h1>";

            $i++;
        }
        ?>
    </div>

    <div class="link-container">
        <a href="./for-piramide.php">Piramide For Loop</a>
        <a href="./do-while-piramide.php">Piramide Do While Loop</a>
    </div>
</body>

</html>