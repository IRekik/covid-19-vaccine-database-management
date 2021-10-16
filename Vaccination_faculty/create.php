<?php require_once '../database.php';

if(isset($_POST["address"]) && isset($_POST["name"]) && isset($_POST["webAddress"]) &&
isset($_POST["type"]) && isset($_POST["phone"]) && isset($_POST["province"])&& isset($_POST["city"]) ){

    $facility = $conn->prepare("INSERT INTO Vaccination_Faculty (address,name,webAddress,type,phone,province,city)
                            VALUES(:address,:name,:webAddress,:type,:phone,:province,:city);");

    $facility->bindParam(':address', $_POST['address']);
    $facility->bindParam(':name', $_POST['name']);
    $facility->bindParam(':webAddress', $_POST['webAddress']);
    $facility->bindParam(':type', $_POST['type']);
    $facility->bindParam(':phone', $_POST['phone']);
    $facility->bindParam(':province', $_POST['province']);
    $facility->bindParam(':city', $_POST['city']);
    

    if($facility->execute()){
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
    <title>Add Facility</title>
    <?php include '../css.php';?>
</head>
<body>
<h1>Add Facility</h1>
    <form action="./create.php" method="post">
        <label for="address"></label>address<br/>
        <input type="text" name="address" id="address"> <br/>

        <label for="name">name</label><br/>
        <input type="text" name="name" id="name"> <br/>

        <label for="webAddress"></label>webAddress<br/>
        <input type="text" name="webAddress" id="webAddress"> <br/>

        <label for="type">type</label><br/>
        <input type="text" name="type" id="type"> <br/>

        <label for="phone">phone</label><br/>
        <input type="text" name="phone" id="phone"> <br/>

        <label for="province"></label>province<br/>
        <input type="text" name="province" id="province"> <br/>

        <label for="city"></label>city<br/>
        <input type="text" name="city" id="city"> <br/>

        <br>
        <button type="submit">Insert</button>

    </form>

    <a href="./">Back to list</a>
</body>
</html>