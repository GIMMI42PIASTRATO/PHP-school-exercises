<?php

declare(strict_types=1);

header('Content-Type: application/json');

require_once '../classes/Calculator.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST["radicand"]) && isset($_POST["nthRoot"])) {
        $radicand = $_POST['radicand'];
        $nthRoot = $_POST['nthRoot'];

        $calculator = Calculator::create();

        try {
            $result = $calculator->calculateRootOfN((float) $radicand, (float) $nthRoot);

            echo json_encode(["result" => $result]);
        } catch (Throwable $e) {
            echo json_encode(["error" => "Espressione non valida"]);
        }
    }
}
