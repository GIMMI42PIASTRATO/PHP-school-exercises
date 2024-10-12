<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Convertire Array a JSON</title>
    <style>
        h1 {
            font-family: Arial, sans-serif;
        }

        pre {
            font-size: 1rem;
        }
    </style>
</head>

<body>
    <?php

    $arr = array("ciao", "sono", "una", "persona", "che", "sa", "scrivere", "a", "battitura");

    $jsonArr = json_encode($arr);
    echo "<h1>Array a JSON</h1>";
    echo "<pre>$jsonArr</pre>";

    echo "<br/>";

    $eta = array("Vittorio Bussano" => 18, "Riccardo Bussano" => 18, "Riccardo Girone" => 17);
    $eta["Lorenzo Giardini"] = 17;

    $jsonEta = json_encode($eta);
    echo "<h1>Array Associativo a JSON</h1>";
    echo "<pre>$jsonEta</pre>";

    ?>
</body>

</html>