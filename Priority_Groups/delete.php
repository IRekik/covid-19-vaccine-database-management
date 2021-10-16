<?php require_once '../database.php';

$GA = $conn->prepare("DELETE FROM Priority_Groups WHERE id = :id;");

$GA->bindParam(':id', $_GET['id']);
$GA->execute();

header("Location: .");
?>