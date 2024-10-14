<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Array di stringhe</title>
    <style>
        pre {
            font-size: 20px;
            font-family: monospace;
        }

        body {
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
    </style>
</head>

<body>
    <?php
    $libri = array("Il Piccolo Principe", "Il Signore degli Anelli", "Il Nome della Rosa", "Il Codice da Vinci", "Il Gattopardo", "Il Barone Rampante", "Il Deserto dei Tartari", "Il Vecchio e il Mare", "Il Giovane Holden", "Il Fu Mattia Pascal");

    $libString = "";
    foreach ($libri as $libro) {
        $libString .= "$libro</br>";
    };

    echo "<pre>$libString</pre>"
    ?>
</body>

</html>