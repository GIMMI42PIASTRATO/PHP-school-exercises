<?php

declare(strict_types=1);

// set_error_handler(function ($errno, $errstr, $errfile, $errline) {
//     throw new ErrorException($errstr, $errno, 0, $errfile, $errline);
// });

try {
    $result = eval("return 1 / 2;");
    var_dump($result);
} catch (Throwable $e) {
    echo "Exception: " . $e->getMessage();
}

// restore_error_handler();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // before get the name from the $_POST array, we need to check if the key exists
    if (isset($_POST['name'])) {
        $name = $_POST['name'];
        echo "Hello, " . $name;
    } else {
        echo "Name is not set";
    }
}

// 子にちわビットリオですドぞよろしくお願いします
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The test page</title>
</head>

<body>
    <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <input type="text" name="name" placeholder="君の名は">
        <input type="submit">
        <?= var_dump(sqrt(-1)) ?>
        <?= $_POST["name"] ?? "boboz boboz boboz boboz" ?>
        <h1>Tangente di PI</h1>
        <?= tan(M_PI) ?>
        <h1>Sono true o false "" e "0"</h1>
        <span>Una stringa vuota ("") è: </span><?= "" ? "true" : "false" ?>
        <br>
        <span>Una stringa con zero ("0") è: </span><?= "0" ? "true" : "false" ?>
        <h1>Quanto fa 6**2</h1>
        <?= round(eval("return 6**2;"), 10) ?>
        <h1>Cosa restituiscono le stringhe se faccio < con un numero</h1>
                <?php $string = "1"; ?>
                <span>"<?= $string ?>" < 0: </span><?= "1" < 0 ? "true" : "false" ?>
    </form>
</body>

</html>