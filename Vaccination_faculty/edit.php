<?php require_once '../database.php';

$statement = $conn->prepare("SELECT v.address, v.name, v.webAddress, v.type, v.phone, v.province, v.city
                                FROM Vaccination_Faculty as v;");
$statement->bindParam(':address', $_GET['address']);
$statement->bindParam(':province', $_POST['province']);
$statement->bindParam(':city', $_POST['city']);

$statement->execute();

$facility = $statement->fetch(PDO::FETCH_ASSOC);



if(isset($_POST["address"]) && isset($_POST["name"]) && isset($_POST["webAddress"]) &&
isset($_POST["type"]) && isset($_POST["phone"]) && isset($_POST["province"])&& isset($_POST["city"]) ){

    $facility = $conn->prepare("UPDATE Vaccination_Faculty SET 
                            address = :address,
                            name = :name,
                            webAddress = :webAddress,
                            type = :type,
                            phone = :phone,
                            province = :province,
                            city = :city
                            WHERE address = :address AND province = :province AND city = :city;");

    $facility->bindParam(':address', $_POST['address']);
    $facility->bindParam(':name', $_POST['name']);
    $facility->bindParam(':webAddress', $_POST['webAddress']);
    $facility->bindParam(':type', $_POST['type']);
    $facility->bindParam(':phone', $_POST['phone']);
    $facility->bindParam(':province', $_POST['province']);
    $facility->bindParam(':city', $_POST['city']);
    $facility->bindParam(':province', $_POST['province']);
    $facility->bindParam(':address', $_POST['address']);
    
    if($facility->execute()){
        header("Location: .");
    }else{
        header("Location: .edit.php?address=".$_POST['address'] + "&province=".$_POST['province'] + "&city=".$_POST['city']) ;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Facility</title>
    <?php include '../css.php';?>
</head>
<body>
<h1>Edit Facility</h1>
    <form action="./edit.php" method="post">

        <label for="name">name</label><br/>
        <input type="text" name="name" id="name" value="<?= $facility["name"]?>"> <br/>

        <label for="webAddress"></label>webAddress<br/>
        <input type="text" name="webAddress" id="webAddress" value="<?= $facility["webAddress"]?>"> <br/>

        <label for="type">type</label><br/>
        <input type="text" name="type" id="type" value="<?= $facility["type"]?>"> <br/>

        <label for="phone">phone</label><br/>
        <input type="text" name="phone" id="phone" value="<?= $facility["phone"]?>"> <br/>
     
        
        <input type="hidden" name="address" id="address" value="<?= $facility["address"]?>"> <br/>
        <input type="hidden" name="province" id="province" value="<?= $facility["province"]?>"> <br/>
        <input type="hidden" name="city" id="city" value="<?= $facility["city"]?>"> <br/>
        <button type="submit">Update</button>
    </form>

    <a href="./">Back to list</a>
</body>
</html>