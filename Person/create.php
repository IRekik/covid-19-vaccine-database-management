<?php require_once '../database.php';

if(isset($_POST["firstName"]) && isset($_POST["lastName"]) && isset($_POST["birthday"]) &&
isset($_POST["email"]) && isset($_POST["telephone"]) && isset($_POST["city"])
&& isset($_POST["province"]) && isset($_POST["address"]) && isset($_POST["postalCode"])
&& isset($_POST["citizenship"]) && isset($_POST["SSN_Passport"]) && isset($_POST["medicare"])){

    $person = $conn->prepare("INSERT INTO Person_info (SSN_Passport,birthday,citizenship,email,lastName,firstName,postalCode,address,province,city)
                            VALUES(:SSN_Passport,:birthday,:citizenship,:email,:lastName,:firstName,:postalCode,:address,:province,:city);");

    $person->bindParam(':SSN_Passport', $_POST['SSN_Passport']);
    $person->bindParam(':birthday', $_POST['birthday']);
    $person->bindParam(':citizenship', $_POST['citizenship']);
    $person->bindParam(':email', $_POST['email']);
    $person->bindParam(':lastName', $_POST['lastName']);
    $person->bindParam(':firstName', $_POST['firstName']);
    $person->bindParam(':postalCode', $_POST['postalCode']);
    $person->bindParam(':address', $_POST['address']);
    $person->bindParam(':province', $_POST['province']);
    $person->bindParam(':city', $_POST['city']);
    
    $medicare = $conn->prepare("INSERT INTO Medicare (medicare,telephone,SSN_Passport)
                            VALUES(:medicare,:telephone,:SSN_Passport)");
    $medicare->bindParam(':SSN_Passport', $_POST['SSN_Passport']);
    $medicare->bindParam(':medicare', $_POST['medicare']);
    $medicare->bindParam(':telephone', $_POST['telephone']);                        

    $person->execute();
    $medicare->execute();

    if(isset($_POST['ifInfected'])){
        $infection = $conn->prepare("INSERT INTO Infection (dateOfInfection)
                            VALUES(:dateOfInfection)");
        $infection->bindParam(':dateOfInfection', $_POST['dateOfInfection']);                        

        $stmt = $conn->prepare("SELECT LAST_INSERT_ID() FROM Infection");
        $last_id = $stmt-> fetch();

        $infected = $conn->prepare("INSERT INTO Infected (infectionCaseId,SSN_Passport)
                    VALUES(:infectionCaseId, :SSN_Passport)");
        $infected->bindParam(':infectionCaseId', $last_id);
        $infected->bindParam(':SSN_Passport', $_POST['SSN_Passport']);

        if($infection->execute() && $infected->execute()){
            header("Location: .");
        }
    }else{
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
    <title>Add person</title>
    <?php include '../css.php';?>
</head>
<body>
<h1>Add person</h1>
    <form action="./create.php" method="post">
        <label for="SSN_Passport"></label>SSN/Passport<br/>
        <input type="text" name="SSN_Passport" id="SSN_Passport"> <br/>

        <label for="firstName">First Name</label><br/>
        <input type="text" name="firstName" id="firstName"> <br/>

        <label for="lastName">Last Name</label><br/>
        <input type="text" name="lastName" id="lastName"> <br/>

        <label for="birthday">birthday</label><br/>
        <input type="date" name="birthday" id="birthday"> <br/>

        <label for="email">email</label><br/>
        <input type="text" name="email" id="email"> <br/>

        <label for="telephone">telephone</label><br/>
        <input type="text" name="telephone" id="telephone"> <br/>

        <label for="address"></label>address<br/>
        <input type="text" name="address" id="address"> <br/>

        <label for="city"></label>city<br/>
        <input type="text" name="city" id="city"> <br/>

        <label for="province"></label>province<br/>
        <input type="text" name="province" id="province"> <br/>

        <label for="postalCode"></label>postalCode<br/>
        <input type="text" name="postalCode" id="postalCode"> <br/>

        <label for="citizenship"></label>citizenship<br/>
        <input type="text" name="citizenship" id="citizenship"> <br/>
        <br>

        <label for="medicare"></label>medicare<br/>
        <input type="text" name="medicare" id="medicare"> <br/>
        <br>

        <input type="radio" id="ifInfected" name="ifInfected" value="yes">
        <label for="ifInfected">Check the button if infected in the past</label><br>

        <label for="dateOfInfection"></label>medicare<br/>
        <input type="text" name="dateOfInfection" id="dateOfInfection"> <br/>
        <br>
        <button type="submit">Insert</button>

    </form>

    <a href="./">Back to list</a>
</body>
</html>