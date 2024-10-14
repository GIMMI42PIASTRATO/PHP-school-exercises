<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambia colore dello sfondo in base al giorno della settimana</title>
</head>

<body>
    <?php
    $dayToColors = array(
        "Monday" => "black",
        "Tuesday" => "royalblue",
        "Wednesday" => "tomato",
        "Thursday" => "coral",
        "Friday" => "aquamarine",
        "Saturday" => "blanchedalmond",
        "Sunday" => "crimson"
    );

    $day = date("l");
    $color = $dayToColors[$day];
    echo "<style>body {background-color: $color;}</style>";
    ?>
</body>

</html>