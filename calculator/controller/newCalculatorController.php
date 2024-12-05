<?php

declare(strict_types=1);

session_start();

// Recupera i dati dal form
$number = $_POST['number'] ?? null;
$operator = $_POST['operator'] ?? null;

// Recupera lo stato della sessione
$expression = $_SESSION['expression'] ?? '';
$result = $_SESSION['result'] ?? 0;
$lastOperator = $_SESSION['lastOperator'] ?? null;

// Se non è presente un numero o un operatore, termina
if ($number === null || $operator === null) {
    header('Location: ../index.php');
    exit;
}

// Aggiorna l'espressione
if ($operator === '=') {
    // Esegui il calcolo finale
    $expression .= $number;
    $result = evalExpression($expression);
    $expression .= '=';
} else {
    // Gestione delle priorità (moltiplicazione e divisione)
    if (in_array($lastOperator, ['*', '/']) && $lastOperator !== null) {
        $partialResult = evalExpression($result . $lastOperator . $number);
        $result = $partialResult;
        $expression .= $number . $operator;
    } else {
        if ($lastOperator) {
            $result = evalExpression($result . $lastOperator . $number);
        } else {
            $result = (float) $number;
        }
        $expression .= $number . $operator;
    }
}

// Salva lo stato nella sessione
$_SESSION['expression'] = $expression;
$_SESSION['result'] = $result;
$_SESSION['lastOperator'] = $operator;

// Reindirizza alla pagina principale
header('Location: ../index.php');
exit;

/**
 * Valuta un'espressione matematica in modo sicuro.
 */
function evalExpression(string $expression): float
{
    // Usa l'uso limitato di `eval` per valutare l'espressione
    $result = 0.0;
    try {
        $result = eval('return ' . $expression . ';');
    } catch (Throwable $e) {
        // Gestione di eventuali errori
        $result = 0.0;
    }
    return $result;
}
