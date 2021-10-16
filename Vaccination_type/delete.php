<?php require_once '../database.php';

$statement = $conn->prepare("DELETE FROM Vaccines WHERE name = :name;");
$statement->bindParam(':name', $_GET['name']);
$statement->execute();


header("Location: .");
?>