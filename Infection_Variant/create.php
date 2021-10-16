<?php require_once '../database.php';

if(isset($_POST["type"])){

    $person = $conn->prepare("INSERT INTO Covid (type)
                            VALUES(:type);");

    $person->bindParam(':type', $_POST['type']);
    if($person->execute()){
        header("Location: .");
    }              
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../css.php';?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add new variant</title>
    <?php include '../css.php';?>
</head>
<body>
<h1>Add variant</h1>
    <form action="./create.php" method="post">
        <label for="type"></label>Variant<br/>
        <input type="text" name="type" id="type"> <br/>
        <br>
        <button type="submit">Insert</button>
    </form>

    <a href="./">Back to list</a>
</body>
</html>