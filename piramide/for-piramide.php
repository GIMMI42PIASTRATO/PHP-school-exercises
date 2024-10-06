<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Piramide con For loop</title>
    <link rel="stylesheet" href="./style.css">
</head>

<body>
    <h1>Piramide con For loop</h1>
    <h2>Base: <?php echo $n = 10; ?></h2>

    <div>
        <?php
        for ($i = 1; $i <= $n; $i++) {
            echo "<h1>";

            for ($j = 1; $j <= $i; $j++) {
                echo "*";
            }

            echo "</h1>";
        }
        ?>
    </div>

    <div class="link-container">
        <a href="./while-piramide.php">Piramide While Loop</a>
        <a href="./do-while-piramide.php">Piramide Do While Loop</a>
    </div>
</body>

</html>