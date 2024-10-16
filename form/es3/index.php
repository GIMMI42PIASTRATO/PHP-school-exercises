<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login finto</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap');

        * {
            font-family: 'Inter', sans-serif;
            box-sizing: border-box;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #09090b;
            color: #fff;
        }

        .container {
            background-color: #0c0a09;
            display: flex;
            flex-direction: column;
            width: 400px;
            border: 1px solid #292524;
            border-radius: 10px;
        }

        form {
            display: flex;
            flex-direction: column;
            padding: 1.5rem;
            padding-top: 0;
        }

        .header {
            text-align: center;
            padding: 1.5rem;
        }

        .header p {
            font-size: 0.8rem;
            color: #8e8985;
        }

        p {
            font-size: 0.8rem;
            color: #8e8985;
        }

        label {
            font-weight: 500;
        }

        input[type="text"],
        input[type="password"] {
            padding: 0.5rem;
            margin-bottom: 1rem;
            border: 1px solid #292524;
            border-radius: 5px;
            margin-top: .5rem;
            background-color: #0c0a09;
            color: #fff;
        }

        input[type="text"]:focus-visible,
        input[type="password"]:focus-visible {
            outline: 2px solid hsl(35.5 91.7% 32.9%);
        }

        ::placeholder {
            color: #96918d;
        }

        button {
            padding: 8px 16px;
            background-color: #facc15;
            color: #000;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 1rem;
            font-weight: 500;
            font-size: 0.875rem;
            line-height: 1.25rem;
        }

        input[type="checkbox"] {
            margin-right: 0.5rem;
            height: 1rem;
            width: 1rem;
            border-radius: 2px;
            border-width: 1px;
        }

        .result {
            margin-left: 2rem;
            margin-top: 1rem;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
    </style>
</head>

<body>
    <?php
    $username = $password = $repeatPassword = $acceptConditions = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST["username"];
        $password = $_POST["password"];
        $repeatPassword = $_POST["repeatPassword"];
        $acceptConditions = $_POST["acceptConditions"];
    }
    ?>

    <div class="container">
        <div class="header">
            <h1>
                Condizioni di abbonamento
            </h1>
            <p>Per aderire al servizio devi inserire un nome utente una password e aderire alle condizioni</p>
        </div>
        <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" placeholder="Jhon Doe" required>

            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="********" required>

            <label for="repeatPassword">Ripeti Password</label>
            <input type="password" name="repeatPassword" id="repeatPassword" placeholder="********" required>

            <label for="conditions">Condizioni</label>
            <p>
                Il sitoweb non si assume nessuna responsabilità per l'uso improprio delle informazioni presenti sul sito.
            </p>

            <div>
                <input type="checkbox" name="acceptConditions" id="acceptConditions" required>
                <label for="acceptConditions">Ho letto ed accetto le condizioni</label>
            </div>

            <button type="submit">Aderisci</button>
        </form>
    </div>

    <div class="result">
        <h2>Valori inseriti</h2>
        <p>Username: <?= $username ?></p>
        <p>Password: <?= $password ?></p>
        <p>Ripeti Password: <?= $repeatPassword ?></p>
        <p>Accettazione condizioni: <?= $acceptConditions ?></p>
    </div>
</body>

</html>