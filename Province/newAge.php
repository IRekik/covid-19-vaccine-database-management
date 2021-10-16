<?php require_once '../database.php';

if(isset($_POST["provincialCode"]) && isset($_POST["groupId"])){

    $priority = $conn->prepare("INSERT INTO qkc353_1.Provincial_priority (provincialCode, groupId, isPrioritized)
                            VALUES(:provincialCode,:groupId,'Yes');");

    
    $priority->bindParam(':provincialCode', $_POST['provincialCode']);
    $priority->bindParam(':groupId', $_POST['groupId']);
    if($priority->execute()){
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
    <title>newAge</title>
    <?php include '../css.php';?>
</head>
<body>
<h1>Add group age to province</h1>
    <form action="./newAge.php" method="post">
        <label for="provincialCode"></label>provincialCode<br/>
        <input type="text" name="provincialCode" id="provincialCode"> <br/>
        <br>
        <label for="groupId"></label>groupID<br/>
        <input type="text" name="groupId" id="groupId"> <br/>
        <br>
        <button type="submit">Insert</button>
    </form>

</body>
</html>