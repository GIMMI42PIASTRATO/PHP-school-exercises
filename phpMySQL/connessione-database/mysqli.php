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
}
