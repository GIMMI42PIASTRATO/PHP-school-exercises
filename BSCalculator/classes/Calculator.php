<?php

declare(strict_types=1);

class Calculator
{
    private static Calculator $instance;

    private function __construct()
    {
        if (!isset($_SESSION['memory'])) {
            $_SESSION['memory'] = 0;
            $_SESSION['hasMemory'] = false;
            $_SESSION['lastResult'] = 0;
        }
    }

    // method used to create a single instance of the class (singleton)
    public static function create(): Calculator
    {
        if (!isset(self::$instance)) {
            self::$instance = new Calculator();
        }

        return self::$instance;
    }

    public function calculate(string $expression, string $operator)
    {
        // Gestione validazione e calcolo dell'espressione
        try {
            // Rimuovi spazi e gestisci espressioni multiple
            $expression = str_replace(' ', '', $expression);

            echo "Before validation: " . $expression . "  " . $operator;

            // Validazione base dell'espressione
            if (!$this->validateExpression($expression)) {
                throw new Exception("Espressione non valida");
            }

            // Sanitizzazione dell'operatore
            $operator = $this->sanitizeOperator($operator);

            echo " After validation: " . $expression . "  " . $operator;

            // Calcolo dell'espressione
            $result = null;
            switch ($operator) {
                case 'equal':
                    if (str_contains($expression, "^")) {
                        // TODO: Aggiusta il problema con il calcola della potenza elevata alla n
                        $result = $this->calculatePowerOfN($expression);
                    } else {
                        $result = $this->evaluateExpression($expression);
                    }
                    break;
                case 'sqrt':
                    $result = $this->calculateSquareRoot($expression);
                    break;
                case 'square':
                    $result = $this->calculateSquare($expression);
                    break;
                case 'inverse':
                    $result = $this->calculateInverse($expression);
                    break;
                case 'sin':
                    $result = $this->calculateSin($expression);
                    break;
                case 'cos':
                    $result = $this->calculateCos($expression);
                    break;
                case 'tan':
                    $result = $this->calculateTan($expression);
                    break;
                case 'factorial':
                    $result = $this->calculateFactorial($expression);
                    break;
                case "abs":
                    $result = $this->safeAbs($expression);
                    break;
                default:
                    throw new Exception();
            }

            // Salva il risultato
            $_SESSION['lastResult'] = $result;
            return $result;
        } catch (Throwable $e) {
            return "Espressione non valida";
        }
    }

    public function validateExpression(string $expression)
    {
        // Regex per validare l'espressione
        $pattern = '/^[0-9+\-*\/\(\)\.^!sincostansecscotsqrtxnsqrt\*√]+$/';

        // Controlli aggiuntivi
        if (!preg_match($pattern, $expression)) {
            return false;
        }

        echo "L'ho passato    ";

        // Controllo operatori consecutivi (escluso **)
        if (preg_match('/(?<!\*)\*{3,}|[+\-\/]{2,}/', $expression)) {
            return false;
        }

        echo "L'ho passato    ";

        // Controllo troppi punti decimali
        if (preg_match('/\d+\.\d*\.\d*/', $expression)) {
            return false;
        }

        echo "L'ho passato    ";

        return true;
    }

    private function sanitizeOperator(string $operator)
    {
        return htmlspecialchars(stripslashes(trim($operator)));
    }

    private function evaluateExpression(string $expression)
    {
        // Calcoli base
        $result = eval("return $expression;");
        return round($result, 10); // Arrotonda per evitare problemi di precisione
    }

    private function calculateSquareRoot(string $expression)
    {
        $result = $this->evaluateExpression($expression);
        $result = sqrt($result);

        if (is_nan($result)) {
            throw new Exception();
        }

        return $result;
    }

    private function calculateSquare(string $expression)
    {
        $result = $this->evaluateExpression($expression);
        return pow($result, 2);
    }

    private function calculatePowerOfN(string $expression)
    {
        $expression = str_replace("^", "**", $expression);
        echo "<div>$expression</div>";
        return $this->evaluateExpression($expression);
    }

    private function calculateFactorial(string $expression)
    {
        $number = str_replace('!', '', $expression);

        // if the number is a float or negative, throw an exception, rembember thath currently $number is a string
        if (str_contains($number, '.') || $number < 0) {
            throw new Exception("Il fattoriale è definito solo per numeri interi positivi.");
        }

        $result = 1;
        for ($i = 1; $i <= $number; $i++) {
            $result *= $i;
        }
        return $result;
    }

    private function calculateSin(string $expression)
    {
        $result = $this->evaluateExpression($expression);

        // Calcolo il seno
        $sinValue = sin($result);

        // Tolleranza per trattare valori molto vicini a zero come zero
        $tolerance = 1e-10;

        return abs($sinValue) < $tolerance ? 0.0 : $sinValue;
    }

    private function calculateCos(string $expression)
    {
        $result = $this->evaluateExpression($expression);

        // Calcolo il coseno
        $cosValue = cos($result);

        // Tolleranza per trattare valori molto vicini a zero come zero
        $tolerance = 1e-10;

        return abs($cosValue) < $tolerance ? 0.0 : $cosValue;
    }

    private function calculateTan(string $expression)
    {
        $result = $this->evaluateExpression($expression);

        // Tolleranza per gestire valori molto piccoli
        $tolerance = 1e-10;

        // Controlla se il denominatore è vicino a zero
        if (abs(cos($result)) < $tolerance) {
            throw new Exception("Tangente non definita per questo valore.");
        }

        // Calcola la tangente
        $tanValue = tan($result);

        // Applica la tolleranza per trattare valori molto piccoli come zero
        return abs($tanValue) < $tolerance ? 0.0 : $tanValue;
    }

    private function calculateInverse(string $expression)
    {
        // TODO: usa questo pattern anche per le altre funzioni, e poi aggiungici un controllo se c'è una radice
        if (str_contains($expression, "^")) {
            $result = $this->calculatePowerOfN($expression);
        } else {
            $result = $this->evaluateExpression($expression);
        }

        if ($result == 0) {
            throw new Exception();
        }

        return 1 / $result;
    }

    private function safeAbs(string $expression)
    {
        if (str_contains($expression, "^")) {
            return abs($this->calculatePowerOfN($expression));
        }

        return abs($this->evaluateExpression($expression));
    }

    public function calculateRootOfN(float $radicand, float $nthRoot)
    {
        if ($radicand < 0 && $nthRoot % 2 == 0) {
            throw new Exception();
        }

        return pow($radicand, 1 / $nthRoot);
    }

    public function storeToMemory(float $value)
    {
        if ($value == 0) {
            $_SESSION["memory"] = $_SESSION["lastResult"];
        } else {
            $_SESSION["memory"] = $value;
        }

        $_SESSION["hasMemory"] = ($_SESSION["memory"] != 0);
        return $value;
    }

    public function recallMemory()
    {
        if ($_SESSION["hasMemory"]) {
            return $_SESSION["memory"];
        } else {
            return 0;
        }
    }

    public function addToMemory(float $value)
    {
        if ($value == 0) {
            $_SESSION["memory"] += $_SESSION["lastResult"];
        } else {
            $_SESSION["memory"] += $value;
        }

        $_SESSION["hasMemory"] = ($_SESSION["memory"] != 0);
        return $_SESSION["memory"];
    }

    public function hasMemory()
    {
        return $_SESSION["hasMemory"];
    }
}
