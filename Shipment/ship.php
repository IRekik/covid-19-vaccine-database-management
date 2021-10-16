<?php require_once '../database.php';

if(isset($_POST["address"]) && isset($_POST["city"]) && isset($_POST["province"]) && isset($_POST["name"]) && isset($_POST["dateOfReception"]) && isset($_POST["numOfVaccines"]) ){

    $GA = $conn->prepare("INSERT INTO Shipment (address,city,province,name,dateOfReception,count)
                            VALUES(:address,:city,:province,:name,:dateOfReception,:numOfVaccines);
                          UPDATE Inventory SET numOfVaccines = numOfVaccines + :numOfVaccines WHERE Inventory.address = :address AND Inventory.province = :province AND Inventory.city = :city AND Inventory.name = :name;
                            ");

    $GA->bindParam(':address', $_POST['address']);
    $GA->bindParam(':city', $_POST['city']);
    $GA->bindParam(':province', $_POST['province']);
    $GA->bindParam(':name', $_POST['name']);
    $GA->bindParam(':dateOfReception', $_POST['dateOfReception']);
    $GA->bindParam(':numOfVaccines', $_POST['numOfVaccines']);

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
<h1>Ship vaccines</h1>
    <form action="./ship.php" method="post">
        <label for="address"></label>address<br/>
        <input type="text" name="address" id="address"> <br/>

        <label for="city"></label>city<br/>
        <input type="text" name="city" id="city"> <br/>

        <label for="province"></label>province<br/>
        <input type="text" name="province" id="province"> <br/>

        <label for="name">Which vaccine</label><br/>
        <input type="text" name="name" id="name"> <br/>
        
        <label for="dateOfReception">Date</label><br/>
        <input type="date" name="dateOfReception" id="dateOfReception"> <br/>

        <label for="numOfVaccines"></label>Number<br/>
        <input type="text" name="numOfVaccines" id="numOfVaccines"> <br/>

        <br>
        <button type="submit">Insert</button>

    </form>

    <a href="./">Back to list</a>
</body>
</html>