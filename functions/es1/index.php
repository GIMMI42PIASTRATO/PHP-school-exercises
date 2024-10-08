<?php

declare(strict_types=1);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Somma di due numeri</title>
</head>

<body>
    <?php

    function sum(int | float  $num1, int  $num2): int | float
    {
        return $num1 + $num2;
    }

    echo "<h1>" . sum(3, 4) . "</h1>"
    ?>
</body>

</html>