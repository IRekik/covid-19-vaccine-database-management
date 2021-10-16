<?php require_once '../database.php';

$statement = $conn->prepare("DELETE FROM Person_info WHERE SSN_Passport = :SSN_Passport;");
$statement->bindParam(':SSN_Passport', $_GET['SSN_Passport']);
$statement->execute();

$medicare = $conn->prepare("DELETE FROM Medicare WHERE SSN_Passport = :SSN_Passport;");
$medicare->bindParam(':SSN_Passport', $_GET['SSN_Passport']);
$medicare->execute();

$stmt = $conn->prepare("SELECT infectionCaseId FROM Infected WHERE SSN_Passport=:SSN_Passport;");
$stmt->bindParam(':SSN_Passport', $_GET['SSN_Passport']);
$infectionCaseId = $stmt-> fetch();

$infection = $conn->prepare("DELETE FROM Infection WHERE caseId = :caseId;");
$infection->bindParam(':caseId', $infectionCaseId);
$infection->execute();

$infected = $conn->prepare("DELETE FROM Infected WHERE SSN_Passport = :SSN_Passport;");
$infected->bindParam(':SSN_Passport', $_GET['SSN_Passport']);
$infected->execute();


header("Location: .");
?>