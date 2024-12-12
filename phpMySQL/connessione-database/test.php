<?php

// Creami una classe per la connessione ad un database mysql

class ConnessioneDatabase
{
    private $connessione;
    private $host;
    private $username;
    private $password;
    private $database;

    public function __construct($host, $username, $password, $database)
    {
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;
    }

    public function connetti()
    {
        $this->connessione = new mysqli($this->host, $this->username, $this->password, $this->database);
        if ($this->connessione->connect_error) {
            die("Connessione fallita: " . $this->connessione->connect_error);
        }
    }

    public function disconnetti()
    {
        $this->connessione->close();
    }

    public function eseguiQuery($query)
    {
        return $this->connessione->query($query);
    }
}

// Creiamo un oggetto della classe ConnessioneDatabase
$database = new ConnessioneDatabase("localhost", "root", "", "test");
$database->connetti();
