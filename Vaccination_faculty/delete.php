<?php require_once '../database.php';

$statement = $conn->prepare("DELETE FROM Vaccination_Faculty WHERE address = :address AND province = :province AND city = :city;");

$statement->bindParam(':address', $_GET['address']);
$statement->bindParam(':province', $_GET['province']);
$statement->bindParam(':city', $_GET['city']);

if($statement->execute()){
  header("Location: .");
}
?>