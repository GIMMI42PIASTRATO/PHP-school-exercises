<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fattoriale</title>
</head>

<body>
    <?php
    for ($i = 0; $i <= 10; $i++) {
        $fattoriale = 1;

        for ($j = 1; $j <= $i; $j++) {
            $fattoriale *= $j;
        }

        echo "Il fattoriale di $i è $fattoriale<br>";
    }
    ?>
</body>

</html>