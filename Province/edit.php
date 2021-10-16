<?php require_once '../database.php';

$statement = $conn->prepare("SELECT * 
                        from qkc353_1.Provincial_priority WHERE provincialCode = :provincialCode");
$statement->bindParam(':provincialCode', $_GET['provincialCode']);                        
$statement->execute();

$person = $statement->fetch(PDO::FETCH_ASSOC);

$statement2 = $conn->prepare("SELECT * 
                        from qkc353_1.Province_priority WHERE provincialCode = :provincialCode");
$statement2->bindParam(':provincialCode', $_GET['provincialCode']);                        
$statement2->execute();

$province = $statement->fetch(PDO::FETCH_ASSOC);

if(isset($_POST["provincialCode"])){

    $person = $conn->prepare("UPDATE qkc353_1.Provincial_priority SET 
                            provincialCode = :provincialCode
                            WHERE provincialCode = :provincialCode;");

    $person->bindParam(':provincialCode', $_GET['provincialCode']);

    $province = $conn->prepare("UPDATE qkc353_1.Province_priority SET 
                                provincialCode = :provincialCode
                                WHERE provincialCode = :provincialCode;");

    $province->bindParam(':provincialCode', $_GET['provincialCode']);                            

    if($person->execute() && $province->execute() ){
        header("Location: .");
    }else{
        header("Location: .edit.php?type=".$_GET['provincialCode']);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit province</title>
    <?php include '../css.php';?>
</head>
<body>
<h1>Edit province</h1>
    <form action="./edit.php" method="post">
        <label for="provincialCode">provincialCode</label><br/>
        <input type="text" name="provincialCode" id="provincialCode" value="<?= $_GET["provincialCode"]?>"> <br/>
        <button type="submit">Update</button>
    </form>

    <a href="./">Back to list</a>
</body>
</html>