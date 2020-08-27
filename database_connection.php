<?php

class DatabaseConnection {
    private $host;
    private $database;
    private $username;
    private $password;
    private $options;

    public function connect(){
        
        $this->host     = "localhost"; 
        $this->database = "sagadb"; 
        $this->username = "root"; 
        $this->password = "admin"; 
        $this->options  = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];

        $dsn = "mysql:host={$this->host};dbname={$this->database}";
        $connection = new PDO($dsn, $this->username, $this->password, $this->options);
        return $connection;
    }
}

?>