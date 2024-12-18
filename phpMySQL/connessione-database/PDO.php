<?php

$servername = "localhost";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$servername", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully<br>";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

try {
    $sql = "CREATE DATABASE IF NOT EXISTS myDBPDO";
    // use exec() because no results are returned
    $conn->exec($sql);
    echo "Database created successfully<br>";
    $conn->exec("USE myDBPDO");
} catch (PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}

try {
    // sql to create table
    $sql = "CREATE TABLE IF NOT EXISTS MyGuests (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(30) NOT NULL,
    lastname VARCHAR(30) NOT NULL,
    email VARCHAR(50),
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";

    // use exec() because no results are returned
    $conn->exec($sql);
    echo "Table MyGuests created successfully<br>";
} catch (PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}

try {
    $sql = "INSERT INTO MyGuests (firstname, lastname, email)
    VALUES ('Mary', 'Moe', 'mary@example.com');";

    $sql .= "INSERT INTO MyGuests (firstname, lastname, email)
    VALUES ('Mario', 'Rossi', '');";

    $sql .= "INSERT INTO MyGuests (firstname, lastname, email)
    VALUES ('Luigi', 'Verdi', 'luigiverdi@example.com');";

    // use exec() because no results are returned
    $conn->exec($sql);
    echo "New record created successfully<br>";

    $last_id = $conn->lastInsertId();
    echo "New record created successfully. Last inserted ID is: " . $last_id . "<br>";
} catch (PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}


try {
    $stmt = $conn->prepare("SELECT id, firstname, lastname FROM MyGuests");
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

    foreach ($stmt->fetchAll() as $k => $v) {
        echo "id: " . $v['id'] . " - Name: " . $v['firstname'] . " " . $v['lastname'] . "<br>";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

try {
    // sql to delete a record
    $sql = "DELETE FROM MyGuests WHERE id = 12";

    // use exec() because no results are returned
    $conn->exec($sql);
    echo "Record deleted successfully<br>";
} catch (PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}

try {
    $sql = "UPDATE MyGuests SET lastname='Doe' WHERE id = 4";

    // Prepare statement
    $stmt = $conn->prepare($sql);

    // execute the query
    $stmt->execute();

    // echo a message to say the UPDATE succeeded
    echo $stmt->rowCount() . " records UPDATED successfully<br>";
} catch (PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}





$conn = null;
