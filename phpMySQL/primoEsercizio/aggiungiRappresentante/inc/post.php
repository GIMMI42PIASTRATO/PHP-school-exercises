<?php

declare(strict_types=1);

require_once "../utils/helper.php";
require_once "../db/db.php";

$inputErrors = [
    "name" => NAME_REQUIRED,
    "surname" => SURNAME_REQUIRED,
    "lastRevenue" => LAST_REVENUE_REQUIRED,
    "region" => REGION_REQUIRED,
    "province" => PROVINCE_REQUIRED,
    "commission_percentage" => COMMISION_PERCENTAGE_REQUIRED,
];

$errors = setErrors($inputErrors);

if (count($errors) === 0) {
    $sanitizedData = [];

    foreach ($inputErrors as $name => $_) {
        $sanitizedData[$name] = sanitizeData($_POST[$name]);
    }

    try {
        $query = "INSERT INTO rappresentante 
        (nome, cognome, ultimo_fatturato, regione, provincia, percentuale_provvigione) 
        VALUES 
        (:name, :surname, :lastRevenue, :region, :province, :commission_percentage);";

        $stmt = $db->prepare($query);

        $stmt->bindParam(':name', $sanitizedData['name']);
        $stmt->bindParam(':surname', $sanitizedData['surname']);
        $stmt->bindParam(':lastRevenue', $sanitizedData['lastRevenue']);
        $stmt->bindParam(':region', $sanitizedData['region']);
        $stmt->bindParam(':province', $sanitizedData['province']);
        $stmt->bindParam(':commission_percentage', $sanitizedData['commission_percentage']);

        $stmt->execute();

        $dbSucces = true;
        $dbError = false;
    } catch (PDOException $e) {
        $dbSucces = false;
        $dbError = true;

        echo $e;
    }
}
