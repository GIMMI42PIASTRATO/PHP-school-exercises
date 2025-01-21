<?php

declare(strict_types=1);

require_once __DIR__ . "/../../utils/helper.php";
require_once __DIR__ . "/../../db/db.php";

$inputErrors = [
    "fiscalCode" => FISCAL_CODE_REQUIRED,
];

$errors = setErrors($inputErrors);

if (count($errors) === 0) {
    $sanitizedFiscalCode = sanitizeData($_POST["fiscalCode"]);

    try {
        $query = "DELETE FROM rappresentante WHERE codice_fiscale = :codice_fiscale";

        $stmt = $db->prepare($query);

        $stmt->bindParam(":codice_fiscale", $sanitizedFiscalCode);

        $stmt->execute();

        if ($stmt->rowCount() === 0) {
            $errors["fiscalCode"] = FISCAL_CODE_NOT_FOUND;
        } else {
            $dbSucces = true;
            $dbError = false;
        }

        $db = null;
    } catch (PDOException $e) {
        $dbSucces = false;
        $dbError = true;

        echo $e;
    }
}
