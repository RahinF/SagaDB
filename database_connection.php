<?php

$host     = 'localhost';
$database = 'sagadb';
$username = 'root';
$password = 'admin';


$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

$connection = new PDO("mysql:host=$host;dbname=$database;", $username, $password, $options);



?>