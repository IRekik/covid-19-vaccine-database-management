<?php require_once '../database.php';

$statement2 = $conn->prepare("DELETE pw,pwi FROM Public_Health_Worker_Info pw 
                              INNER JOIN Public_Health_Worker_Id pwi ON pw.EID = pwi.EID
                              WHERE pw.EID = :EID;");
$statement2->bindParam(':EID', $_GET['EID']);
$statement2->execute();

header("Location: .");
?>