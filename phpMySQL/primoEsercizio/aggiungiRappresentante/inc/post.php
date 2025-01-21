<?php

declare(strict_types=1);

require_once __DIR__ . "/../../utils/helper.php";
require_once __DIR__ . "/../../db/db.php";

// array that associates the input with its required_error
$inputErrors = [
    "fiscalCode" => FISCAL_CODE_REQUIRED,
    "name" => NAME_REQUIRED,
    "surname" => SURNAME_REQUIRED,
    "lastRevenue" => LAST_REVENUE_REQUIRED,
    "region" => REGION_REQUIRED,
    "province" => PROVINCE_REQUIRED,
    "commission_percentage" => COMMISION_PERCENTAGE_REQUIRED,
];

// fills the array with errors if there are any
$errors = setErrors($inputErrors);

if (count($errors) === 0) {
    $sanitizedData = [];

    // sanitize the data
    foreach ($inputErrors as $name => $_) {
        $sanitizedData[$name] = sanitizeData($_POST[$name]);
    }

    try {
        // check if there is arleady a match in the database with the CF inserted by the user
        $query = "SELECT codice_fiscale FROM rappresentante WHERE codice_fiscale = :codice_fiscale;";

        $stmt = $db->prepare($query);
        $stmt->bindParam(":codice_fiscale", $sanitizedData["fiscalCode"]);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $errors["fiscalCode"] = FISCAL_CODE_ARLEADY_USED;
        } else {
            // add the rappresentante in the database
            $query = "INSERT INTO rappresentante 
            (codice_fiscale, nome, cognome, ultimo_fatturato, regione, provincia, percentuale_provvigione) 
            VALUES 
            (:codice_fiscale, :name, :surname, :lastRevenue, :region, :province, :commission_percentage);";

            $stmt = $db->prepare($query);

            $stmt->bindParam(':codice_fiscale', $sanitizedData['fiscalCode']);
            $stmt->bindParam(':name', $sanitizedData['name']);
            $stmt->bindParam(':surname', $sanitizedData['surname']);
            $stmt->bindParam(':lastRevenue', $sanitizedData['lastRevenue']);
            $stmt->bindParam(':region', $sanitizedData['region']);
            $stmt->bindParam(':province', $sanitizedData['province']);
            $stmt->bindParam(':commission_percentage', $sanitizedData['commission_percentage']);

            $stmt->execute();

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
