<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Indice Esercizi Form</title>
    <link rel="stylesheet" href="./style.css">
    <script src="./script.js" defer></script>
</head>

<body>
    <div class="table">
        <div class="tableHeader">
            <p>Exercise</p>
            <p>Category</p>
            <p>Complexity</p>
        </div>

        <?php
        $projects = [
            [
                "id" => 1,
                "path" => "./es1",
                "projectName" => "Esercizio 1",
                "category" => "Classes",
                "complexity" => "Easy ASF",
            ],
            [
                "id" => 2,
                "path" => "./es2",
                "projectName" => "Esercizio 2",
                "category" => "Classes",
                "complexity" => "Easy ASF",
            ],
            [
                "id" => 3,
                "path" => "./es3",
                "projectName" => "Esercizio 3",
                "category" => "Classes",
                "complexity" => "Easy ASF",
            ],
            [
                "id" => 4,
                "path" => "./ereditarietaES1",
                "projectName" => "Ereditarietà Esercizio 1",
                "category" => "Inheritance",
                "complexity" => "Easy",
            ]

        ];
        ?>

        <?php foreach ($projects as $project) : ?>
            <div class='rowDividier'></div>
            <div class='tableRow' data-path='<?= htmlspecialchars($project['path']) ?>'>
                <p><?= $project['projectName'] ?></p>
                <p><?= $project['category'] ?></p>
                <p class='projectDate'><?= $project["complexity"] ?></p>
                <div class='hoverBackground'></div>
            </div>
        <?php endforeach  ?>
    </div>
</body>

</html>