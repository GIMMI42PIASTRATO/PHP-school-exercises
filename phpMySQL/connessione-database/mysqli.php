<?php

declare(strict_types=1);

class MySQLiConnection
{
    private mysqli $connection;

    public function __construct(string $username = "root", string $password = "", string $hostname = "localhost")
    {
        $this->connection = new mysqli($hostname, $username, $password);

        if ($this->connection->connect_error) {
            die("Connection Failed: " . $this->connection->connect_error);
        }
    }

    public function getConnection(): mysqli
    {
        return $this->connection;
    }

    public function selectDatabase(string $database): void
    {
        if ($this->connection->select_db($database) === false) {
            die("Database selection failed: " . $this->connection->error);
        }
    }

    public function executeQuery(string $query): mysqli_result
    {
        $result = $this->connection->query($query);

        if ($result === false) {
            die("Query failed: " . $this->connection->error);
        }

        return $result;
    }

    public function closeConnection(): void
    {
        $this->connection->close();
    }
}
