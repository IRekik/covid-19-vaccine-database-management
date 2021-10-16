<?php require_once '../database.php';

if(isset($_POST["SSN_Passport"]) && isset($_POST["address"]) && isset($_POST["province"]) && isset($_POST["city"]) && isset($_POST["EID"]) && isset($_POST["name"]) && isset($_POST["date"]) && isset($_POST["dose"]) ){

    $GA = $conn->prepare("INSERT INTO Vaccination (doseNumber,date,SSN_Passport,typeOfVaccine,name,address,province,city,EID)
                            VALUES(:dose,:date,:SSN_Passport, NULL,:name,:address ,:province, :city,:EID);
                            ");

    $GA->bindParam(':SSN_Passport', $_POST['SSN_Passport']);
    $GA->bindParam(':address', $_POST['address']);
    $GA->bindParam(':city', $_POST['city']);
    $GA->bindParam(':province', $_POST['province']);
    $GA->bindParam(':EID', $_POST['EID']);
    $GA->bindParam(':name', $_POST['name']);
    $GA->bindParam(':date', $_POST['date']);
    $GA->bindParam(':dose', $_POST['dose']);

    if($GA->execute()){
        header("Location: .");
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
    <title>Add Group</title>
    <?php include '../css.php';?>
</head>
<body>
<h1>Enter person information</h1>
    <form action="./Vaccinate.php" method="post">
        <label for="SSN_Passport"></label>SSN of the person<br/>
        <input type="text" name="SSN_Passport" id="SSN_Passport"> <br/>

        <label for="address"></label>Location address<br/>
        <input type="text" name="address" id="address"> <br/>
        
        <label for="city"></label>City<br/>
        <input type="text" name="city" id="city"> <br/>
        
        <label for="province"></label>Province<br/>
        <input type="text" name="province" id="province"> <br/>
        
        <label for="EID"></label>ID of Employee performing the vaccination<br/>
        <input type="text" name="EID" id="EID"> <br/>

        <label for="name">Which vaccine</label><br/>
        <input type="text" name="name" id="name"> <br/>
        
        <label for="date">Date</label><br/>
        <input type="date" name="date" id="date"> <br/>

        <label for="dose"></label>Dose Number<br/>
        <input type="text" name="dose" id="dose"> <br/>

        <br>
        <button type="submit">Insert</button>

    </form>

    <a href="./">Back to list</a>
</body>
</html>