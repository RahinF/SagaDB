<?php

$host = 'localhost';
$db   = 'sagadb';
$user = 'root';
$pass = 'admin';


$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

$pdo = new PDO("mysql:host=$host;dbname=$db;", $user, $pass, $options);

?>