<?php

require_once "./db.php";

function getRisorse(PDO &$conn): PDOStatement | false
{
    $sql = "SELECT * FROM risorsa";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC) ? $stmt : false;

    return $result;
}

class TableRows extends RecursiveIteratorIterator
{
    function __construct($it)
    {
        parent::__construct($it, self::LEAVES_ONLY);
    }

    function current(): mixed
    {
        return "<td style='width:150px;border:1px solid black;'>" . parent::current() . "</td>";
    }

    function beginChildren(): void
    {
        echo "<tr>";
    }

    function endChildren(): void
    {
        echo "</tr>" . "\n";
    }
}

$result = getRisorse($conn);

if (!$result) {
    echo "An error occured";
}

echo "<table style='border: solid 1px black;'>";
echo "<tr><th>Id</th><th>Firstname</th><th>Lastname</th></tr>";


foreach (new TableRows(new RecursiveArrayIterator($result->fetchAll())) as $k => $v) {
    echo $v;
}
