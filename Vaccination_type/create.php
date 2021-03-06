<?php require_once '../database.php';

if(isset($_POST["name"]) && isset($_POST["dateOfApproval"]) && isset($_POST["type"])){
    
    $date = $_POST['dateOfSuspension'];
    
    if(!empty($date)){
    $person = $conn->prepare("INSERT INTO qkc353_1.Vaccines (name,dateOfApproval,type,dateOfSuspension)
                            VALUES(:name,:dateOfApproval,:type,:dateOfSuspension);");
    
    $person->bindParam(':dateOfSuspension', $_POST['dateOfSuspension']);
    }else{
    $person = $conn->prepare("INSERT INTO qkc353_1.Vaccines (name,dateOfApproval,type)
                            VALUES(:name,:dateOfApproval,:type);");
    
    }
    $person->bindParam(':name', $_POST['name']);
    $person->bindParam(':dateOfApproval', $_POST['dateOfApproval']);
    $person->bindParam(':type', $_POST['type']);
        
    if($person->execute()){
        header("Location: .");
    }    
    
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Vaccine</title>
    <?php include '../css.php';?>
</head>
<body>
<h1>Add Vaccine</h1>
    <form action="./create.php" method="post">
        

        <label for="name">name</label><br/>
        <input type="text" name="name" id="name"> <br/>

        <label for="dateOfApproval">date of approval</label><br/>
        <input type="date" name="dateOfApproval" id="dateOfApproval"> <br/>

        <label for="type">type</label><br/>
        <input type="text" name="type" id="type"> <br/>

        <label for="dateOfSuspension">dateOfSuspension is applicable</label><br/>
        <input type="date" name="dateOfSuspension" id="dateOfSuspension"> <br/>


        <br>
        <button type="submit">Insert</button>

    </form>

    <a href="./">Back to list</a>
</body>
</html>      