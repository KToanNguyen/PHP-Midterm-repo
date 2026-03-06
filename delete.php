<?php
require 'includes/connect.php'; 

//Make sure IDs are received
$customerId = $_GET['id']; 

//Creating query 
$sql = "DELETE from reviews WHERE id = :id"; 

//Query preparing
$stmt = $pdo->prepare($sql); 

//Binding parameters
$stmt->bindParam(':customer_id', $customerId);

//Execute!
$stmt->execute(); 

exit; 
?>