<?php

declare(strict_types=1);

class Calculator
{
    private $memory = 0;
    private $hasMemory = false;

    public function calculate(string $expression, string $operator, string | null $exponent)
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
            switch ($operator) {
                case 'equal':
                    return $this->evaluateExpression($expression);
                case 'sqrt':
                    return $this->calculateSquareRoot($expression);
                case 'square':
                    return $this->calculatePower($expression, $exponent);
                case 'inverse':
                    return $this->calculateInverse($expression);
                case 'sin':
                    return $this->calculateSin($expression);
                case 'cos':
                    return $this->calculateCos($expression);
                case 'tan':
                    return $this->calculateTan($expression);
                default:
                    throw new Exception();
            }
        } catch (Throwable $e) {
            return "Espressione non valida";
        }
    }

    private function validateExpression(string $expression)
    {
        // Regex per validare l'espressione
        $pattern = '/^[0-9+\-*\/\(\)\.^!sincostansecscotsqrtxnsqrt\*]+$/';

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

    private function calculatePower(string $expression, string | null $exponent)
    {
        if ($exponent === null) {
            $result = $this->evaluateExpression($expression);
            return pow($result, 2);
        }

        $exponent = $this->evaluateExpression($exponent);
        return pow($expression, $exponent);
    }

    private function calculateFactorial(string $expression)
    {
        $number = intval(str_replace('!', '', $expression));
        $result = 1;
        for ($i = 1; $i <= $number; $i++) {
            $result *= $i;
        }
        return $result;
    }

    private function calculateSin(string $expression)
    {
        $result = $this->evaluateExpression($expression);
        return sin($result);
    }

    private function calculateCos(string $expression)
    {
        $result = $this->evaluateExpression($expression);
        return cos($result);
    }

    private function calculateTan(string $expression)
    {
        $result = $this->evaluateExpression($expression);
        if (cos($result) == 0) {
            throw new Exception();
        }

        return tan($result);
    }

    private function calculateInverse(string $expression)
    {
        $result = $this->evaluateExpression($expression);

        if ($result == 0) {
            throw new Exception();
        }

        return 1 / $result;
    }

    public function storeToMemory($value)
    {
        $this->memory = $value;
        $this->hasMemory = true;
        return $value;
    }

    public function recallMemory()
    {
        return $this->memory;
    }

    public function addToMemory($value)
    {
        $this->memory += $value;
        $this->hasMemory = ($this->memory != 0);
        return $this->memory;
    }

    public function hasMemory()
    {
        return $this->hasMemory;
    }
}
