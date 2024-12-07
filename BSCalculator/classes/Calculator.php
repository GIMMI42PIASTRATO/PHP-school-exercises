<?php

class Calculator
{
    private $memory = 0;
    private $hasMemory = false;

    public function calculate($expression)
    {
        // Gestione validazione e calcolo dell'espressione
        try {
            // Rimuovi spazi e gestisci espressioni multiple
            $expression = str_replace(' ', '', $expression);

            echo "Before validation: " . $expression;

            // Validazione base dell'espressione
            if (!$this->validateExpression($expression)) {
                throw new Exception("Espressione non valida");
            }

            echo " After validation: " . $expression;

            $result = $this->evaluateExpression($expression);
            return $result;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    private function validateExpression($expression)
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

    private function evaluateExpression($expression)
    {
        // Calcoli base
        $result = eval("return $expression;");

        return round($result, 10); // Arrotonda per evitare problemi di precisione
    }

    private function calculateSquareRoot($expression)
    {
        $number = str_replace('sqrt(', '', rtrim($expression, ')'));
        return sqrt($number);
    }

    private function calculatePower($expression)
    {
        list($base, $exponent) = explode('^', $expression);
        return pow($base, $exponent);
    }

    private function calculateFactorial($expression)
    {
        $number = intval(str_replace('!', '', $expression));
        $result = 1;
        for ($i = 1; $i <= $number; $i++) {
            $result *= $i;
        }
        return $result;
    }

    private function calculateTrigonometric($expression)
    {
        if (strpos($expression, 'sin') !== false) {
            $angle = floatval(str_replace('sin(', '', rtrim($expression, ')')));
            return sin(deg2rad($angle));
        }
        if (strpos($expression, 'cos') !== false) {
            $angle = floatval(str_replace('cos(', '', rtrim($expression, ')')));
            return cos(deg2rad($angle));
        }
        if (strpos($expression, 'tan') !== false) {
            $angle = floatval(str_replace('tan(', '', rtrim($expression, ')')));
            return tan(deg2rad($angle));
        }
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
