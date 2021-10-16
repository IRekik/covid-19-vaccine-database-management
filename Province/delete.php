<?php require_once '../database.php';

$statement = $conn->prepare("DELETE FROM Province_priority WHERE provincialCode = :provincialCode;");
$statement->bindParam(':provincialCode', $_GET['provincialCode']);


if($statement->execute()){
  header("Location: .");
}
?>