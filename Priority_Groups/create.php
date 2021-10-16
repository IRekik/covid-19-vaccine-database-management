<?php require_once '../database.php';

if(isset($_POST["id"]) && isset($_POST["ageMin"]) && isset($_POST["ageMAx"]) ){

    $GA = $conn->prepare("INSERT INTO Priority_Groups (id,ageMin,ageMAx)
                            VALUES(:id,:ageMin,:ageMAx);");

    $GA->bindParam(':id', $_POST['id']);
    $GA->bindParam(':ageMin', $_POST['ageMin']);
    $GA->bindParam(':ageMAx', $_POST['ageMAx']);
    

    if($GA->execute()){
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
    <title>Add Group</title>
    <?php include '../css.php';?>
</head>
<body>
<h1>Add Group</h1>
    <form action="./create.php" method="post">
        <label for="id"></label>id<br/>
        <input type="text" name="id" id="id"> <br/>

        <label for="ageMin">Minimal Age</label><br/>
        <input type="text" name="ageMin" id="ageMin"> <br/>

        <label for="ageMAx"></label>Maximal Age<br/>
        <input type="text" name="ageMAx" id="ageMAx"> <br/>

        <br>
        <button type="submit">Insert</button>

    </form>

    <a href="./">Back to list</a>
</body>
</html>