<?php require_once '../database.php';

$statement = $conn->prepare("DELETE FROM Covid WHERE type = :type;");
$statement->bindParam(':type', $_GET['type']);
$statement->execute();

$statement2 = $conn->prepare("DELETE FROM Infection_type WHERE type = :type;");
$statement2->bindParam(':type', $_GET['type']);
$statement2->execute();

header("Location: .");
?>