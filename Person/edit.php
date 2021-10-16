<?php require_once '../database.php';

$statement = $conn->prepare("SELECT Person_info.firstName, Person_info.lastName, Person_info.birthday, Person_info.email, Medicare.telephone, Person_info.city 
                        FROM Person_info,Medicare
                        WHERE Person_info.SSN_Passport = Medicare.SSN_Passport AND Person_info.SSN_Passport = :SSN_Passport AND Medicare.SSN_Passport = :SSN_Passport;");
$statement->bindParam(":SSN_Passport", $_GET["SSN_Passport"]); 
$statement->execute();

$person = $statement->fetch(PDO::FETCH_ASSOC);



if(isset($_POST["firstName"]) && isset($_POST["lastName"]) && isset($_POST["birthday"]) &&
isset($_POST["email"]) && isset($_POST["telephone"]) && isset($_POST["city"]) && isset($_POST["SSN_Passport"])){

    $person = $conn->prepare("UPDATE Person_info SET 
                            birthday = :birthday,
                            email = :email,
                            lastName = :lastName,
                            firstName = :firstName,
                            city = :city
                            WHERE SSN_Passport = :SSN_Passport;
                            
                            UPDATE Medicare SET 
                                telephone = :telephone
                                WHERE SSN_Passport = :SSN_Passport;
                            ");
    
    
    $person->bindParam(':SSN_Passport', $_POST['SSN_Passport']);
    $person->bindParam(':birthday', $_POST['birthday']);
    $person->bindParam(':email', $_POST['email']);
    $person->bindParam(':lastName', $_POST['lastName']);
    $person->bindParam(':firstName', $_POST['firstName']);
    $person->bindParam(':city', $_POST['city']);
    $person->bindParam(':telephone', $_POST['telephone']);                            
                           
    
    if($person->execute()){
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
        <input type="text" name="firstName" id="firstName" value="<?= $person["firstName"]?>"> <br/>

        <label for="lastName">Last Name</label><br/>
        <input type="text" name="lastName" id="lastName" value="<?= $person["lastName"]?>"> <br/>

        <label for="birthday">birthday</label><br/>
        <input type="date" name="birthday" id="birthday" value="<?= $person["birthday"]?>"> <br/>

        <label for="email">email</label><br/>
        <input type="text" name="email" id="email" value="<?= $person["email"]?>"> <br/>

        <label for="telephone">telephone</label><br/>
        <input type="text" name="telephone" id="telephone" value="<?= $person["telephone"]?>"> <br/>

        <label for="city"></label>city<br/>
        <input type="text" name="city" id="city" value="<?= $person["city"]?>"> <br/>

        <input type="hidden" name="SSN_Passport" id="SSN_Passport" value="<?= $_GET["SSN_Passport"]?>"> <br/>
        <button type="submit">Update</button>
    </form>

    <a href="./">Back to list</a>
</body>
</html>