<?php

// database login
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = 'admin';
$DATABASE_NAME = 'sagadb';

// // Connect to the database
// $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

// // display success or fail
// if ( mysqli_connect_errno() ) {
// 	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
// } 


// pdo
// try {
//     $pdo = new PDO("mysql:host=$DATABASE_HOST;dbname=$DATABASE_NAME",$DATABASE_USER,$DATABASE_PASS);
//     echo 'Connected to Database<br/>';}
// 	catch(PDOException $e)
//     {
//     echo $e->getMessage();
// 	}
	

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