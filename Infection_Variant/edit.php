<?php require_once '../database.php';

$statement = $conn->prepare("SELECT * 
                        from Covid WHERE Covid.type = :type");
$statement->bindParam(':type', $_GET['type']);                        
$statement->execute();

$person = $statement->fetch(PDO::FETCH_ASSOC);



if(isset($_POST["newType"])){

    $statement = $conn->prepare("UPDATE Covid SET 
                            type = :newType
                            WHERE type = :type;");

    $statement->bindParam(':newType', $_POST['newType']);
    $statement->bindParam(':type', $_GET['type']);

    if($statement->execute()){
        header("Location: .");
    }else{
        header("Location: .edit.php?type=".$_GET['type']);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit variant</title>
    <?php include '../css.php';?>
</head>
<body>
<h1>Edit variant</h1>
    <form action="./edit.php" method="post">
        <label for="newType">Variant name</label><br/>
        <input type="text" name="newType" id="newType" value="<?= $_GET["type"]?>"> <br/>
        <button type="submit">Update</button>
    </form>

    <a href="./">Back to list</a>
</body>
</html>