<?php require_once '../database.php';

$statement1 = $conn->prepare('INSERT INTO Transfer VALUES("4513 Saint-Tabernak street","Kinston","ON","1084 Fourrier street","Montreal","QC","Moderna","2021-06-06",25);');
$statement2 = $conn->prepare('UPDATE Inventory
SET
	numOfVaccines = numOfVaccines - 25
WHERE
	address = "4513 Saint-Tabernak street" AND name = "Moderna";');
$statement3 = $conn->prepare ('UPDATE Inventory
SET 
	numOfVaccines = numOfVaccines + 25
WHERE
    address = "1084 Fourrier street" AND name = "Moderna";');
    
$statement1->execute();
$statement2->execute();
$statement3->execute();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include '../css.php';?>
</head>
<body>
    <h1>Query 10</h1>
    <p>Successfully updated</p>
    <a href="../">Back to homepage</a>
</body>
</html>