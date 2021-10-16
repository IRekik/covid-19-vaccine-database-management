<?php require_once '../database.php';


$statement = $conn->prepare('SELECT * FROM Priority_Groups AS g WHERE g.id = :id;');
$statement->bindParam(':id', $_GET['id']);
$statement->execute();

$GA = $statement->fetch(PDO::FETCH_ASSOC);



if(isset($_POST["id"]) && isset($_POST["AgeMin"]) && isset($_POST["AgeMAx"]) ){

    $statement = $conn->prepare("UPDATE Priority_Groups SET 
                            ageMin = :ageMin,
                            ageMAx = :ageMAx
                            WHERE id = :id;");

    $statement ->bindParam(':ageMin', $_POST['ageMin']);
    $statement ->bindParam(':ageMAx', $_POST['ageMAx']);
    $statement ->bindParam(':id', $_POST['id']);

    
    if($statement->execute()){
        header("Location: .");
    }else{
        header("Location: .edit.php?id=".$_POST['id']) ;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Priority Groups</title>
    <?php include '../css.php';?>
</head>
<body>
<h1>Edit Priority Groups</h1>
    <form action="./edit.php" method="post">

        <label for="ageMin"></label> Min Age<br/>
        <input type="text" name="ageMin" id="ageMin" value="<?= $GA["ageMin"]?>"> <br/>

        <label for="ageMAx">Max Age</label><br/>
        <input type="text" name="ageMAx" id="ageMAx" value="<?= $GA["ageMAx"]?>"> <br/>
     
        
        <input type="hidden" name="id" id="id" value="<?= $GA["id"]?>"> <br/>

        <button type="submit">Update</button>
    </form>

    <a href="./">Back to list</a>
</body>
</html>