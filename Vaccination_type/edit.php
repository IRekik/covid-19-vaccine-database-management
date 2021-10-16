<?php require_once '../database.php';

$name = $_GET['name'];

$statement = $conn->prepare("SELECT name,dateOfApproval,type,dateOfSuspension
                        FROM Vaccines
                        WHERE name = :name;");
$statement->bindParam(":name", $_GET["name"]); 
$statement->execute();

$vaccines = $statement->fetch(PDO::FETCH_ASSOC);


if(!empty("dateOfApproval") && isset($_POST["type"])){
    
    $dateOfApproval = $_POST['dateOfApproval'];
    $type = $_POST['type'];
    $dateOfSuspension = $_POST['dateOfSuspension'];   
    
    
    /*
    $vaccines = $conn->prepare("UPDATE Vaccines SET
                              dateOfApproval = :dateOfApproval,
                              type = :type,
                              dateOfSuspension = :dateOfSuspension
                              WHERE name=:name;");
    
    $vaccines->bindParam(':dateOfApproval', $_POST['dateOfApproval']); 
    $vaccines->bindParam(':type', $_POST['type']); 
    $vaccines->bindParam(':dateOfSuspension', $_POST['dateOfSuspension']);                           
    $vaccines->bindParam(':name', $_POST['name']);
    
    
    
    
    */
    
    $vaccines = $conn->prepare("UPDATE Vaccines SET
                              dateOfApproval = ?,
                              type = ?,
                              dateOfSuspension = ?
                              WHERE name=?;");
    
    $vaccines->execute(array($_POST['dateOfApproval'], $_POST['type'],$_POST['dateOfSuspension'],$_POST['name']));
    
    
    if($vaccines->rowCount()){
        header("Location: .");
    }else{
        
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit vaccine type</title>
    <?php include '../css.php';?>
</head>
<body>
<h1>Edit Vaccine type</h1>
    <form action="./edit.php" method="post">

        <label for="dateOfApproval">Date of Approval</label><br/>
        <input type="date" name="dateOfApproval" id="dateOfApproval" value="<?= $vaccines["dateOfApproval"]?>"> <br/>

        <label for="type">Type</label><br/>
        <input type="text" name="type" id="type" value="<?= $vaccines["type"]?>"> <br/>

        <label for="dateOfSuspension">Date of Suspension</label><br/>
        <input type="date" name="dateOfSuspension" id="dateOfSuspension" value="<?= $vaccines["dateOfSuspension"]?>"> <br/>

        <button type="submit" name="update" id="update">Update</button>
    </form>

    <a href="./">Back to list</a>
</body>
</html>