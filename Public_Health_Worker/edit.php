<?php require_once '../database.php';

$statement = $conn->prepare("SELECT Public_Health_Worker_Info.firstName, Public_Health_Worker_Info.lastName, Public_Health_Worker_Info.email, Public_Health_Worker_Info.city 
                        from Public_Health_Worker_Info
                        where Public_Health_Worker_Info.EID = :EID;");
$statement->bindParam(":EID", $_GET["EID"]); 
$statement->execute();

$person = $statement->fetch(PDO::FETCH_ASSOC);



if(isset($_POST["firstName"]) && isset($_POST["lastName"])  &&
isset($_POST["email"]) && isset($_POST["city"]) && isset($_POST["EID"])){

    $statement = $conn->prepare("UPDATE Public_Health_Worker_Info SET 
                            firstName = :firstName,
                            lastName = :lastName,
                            email = :email,
                            city = :city
                            WHERE EID = :EID;");

    $statement->bindParam(':EID', $_GET['EID']);
    $statement->bindParam(':email', $_POST['email']);
    $statement->bindParam(':lastName', $_POST['lastName']);
    $statement->bindParam(':firstName', $_POST['firstName']);
    $statement->bindParam(':city', $_POST['city']);

    if($statement->execute()){
        header("Location: .");
    }else{
        header("Location: .edit.php?SSN_Passport=".$_POST['SSN_Passport']);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit person</title>
    <?php include '../css.php';?>
</head>
<body>
<h1>Edit person</h1>
    <form action="./edit.php" method="post">
        <label for="firstName">First Name</label><br/>
        <input type="text" name="firstName" id="firstName" value='<?= $person["firstName"]?>'> <br/>

        <label for="lastName">Last Name</label><br/>
        <input type="text" name="lastName" id="lastName" value="<?= $person["lastName"]?>"> <br/>

        <label for="email">email</label><br/>
        <input type="text" name="email" id="email" value="<?= $person["email"]?>"> <br/>

        <label for="city"></label>city<br/>
        <input type="text" name="city" id="city" value="<?= $person["city"]?>"> <br/>

        <input type="hidden" name="EID" id="EID" value="<?= $_GET['EID']?>"> <br/>
        <button type="submit">Update</button>
    </form>

    <a href="./">Back to list</a>
</body>
</html>