<?php

declare(strict_types=1);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Operazioni</title>
    <style>
        body {
            margin: 0
        }

        div {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        input {
            margin: 10px;
            padding: 5px;
        }

        select {
            margin: 10px;
            padding: 5px;
        }

        pre {
            color: red;
            font-size: 1rem;
        }
    </style>
</head>

<body>
    <?php
    $num1 = $num2 = $result = 0;
    $selectedOperator = $error = "";

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $num1 = (float) $_POST["num1"];
        $num2 = (float) $_POST["num2"];
        $selectedOperator = (string) $_POST["operator"];


        switch ($selectedOperator) {
            case "+":
                $result = $num1 + $num2;
                break;

            case "-":
                $result = $num1 - $num2;
                break;

            case "*":
                $result = $num1 * $num2;
                break;

            case "/":
                if ($num2 == 0) {
                    $error = "ERROR: Can't divide by zero";
                    break;
                }

                $result = $num1 / $num2;
                break;

            case "**":
                $result = $num1 ** $num2;
                break;
        }
    }
    ?>
    <div>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <input type="number" name="num1" value="<?php echo $num1; ?>" required>
            <!-- how can i set the value of the select to the previusly used -->
            <select name="operator" required>
                <?php
                $operators = ["+", "-", "*", "/", "**"];

                foreach ($operators as $op) {
                    echo "<option value='$op'" . ($selectedOperator === $op ? 'selected' : "") . ">$op</option>";
                }
                ?>
            </select>
            <input type="number" name="num2" value="<?php echo $num2; ?>" required>
            <input type="submit" value="Calcoala">
        </form>

        <?php
        if ($error) {
            echo "<pre>$error</pre>";
        } else {
            echo "<h1>$result</h1>";
        }
        ?>
    </div>
</body>

</html>