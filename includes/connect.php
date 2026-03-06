<?php
declare(strict_types=1);

$host = "127.0.0.1:3308"; //hostname
$db = "book_manager"; //database
$user = "root"; //username
$password = ""; //password

//Pointing to the database
$dsn = "mysql:host=$host;dbname=$db";

try {
   $pdo = new PDO ($dsn, $user, $password); 
   $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
   echo "<p> You have been connected! </p>"; 
}
 
catch(PDOException $e) {
    die("Database connection failed: " . $e->getMessage()); 
}

