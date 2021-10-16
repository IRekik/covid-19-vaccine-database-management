<?php require_once '../database.php';
if(isset($_POST["provincialCode"])){

    $person = $conn->prepare("INSERT INTO qkc353_1.Province_priority (provincialCode)
                            VALUES(:provincialCode);");

    $person->bindParam(':provincialCode', $_POST['provincialCode']);
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
    <title>Add new province</title>
    <?php include '../css.php';?>
</head>
<body>
<h1>Add province</h1>
    <form action="./create.php" method="post">
        <label for="provincialCode"></label>provincialCode<br/>
        <input type="text" name="provincialCode" id="provincialCode"> <br/>
        <br>
        <button type="submit">Insert</button>
    </form>

    <a href="./">Back to list</a>
</body>
</html>