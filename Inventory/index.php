<?php require_once '../database.php';

$statement = $conn->prepare('SELECT i.address, i.city, i.province, i.name, i.numOfVaccines
                                      FROM Inventory as i
                                      GROUP BY i.address, i.city, i.province, i.name;');
$statement->execute();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include '../css.php';?>
</head>
<body>
    <h1>Inventory</h1>
    <table border: 1px solid black;>
        <thead>
            <tr>
                <td>Address</td>
                <td>City</td>
                <td>Province</td>
                <td>name of Vaccine</td>
                <td>Number of Vaccines</td>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)){?>
                <tr>
                    <td><?= $row["address"]?></td>
                    <td><?= $row["city"]?></td>
                    <td><?= $row["province"]?></td>
                    <td><?= $row["name"]?></td>
                    <td><?= $row["numOfVaccines"]?></td>
                </tr>
            <?php } ?>    
            
        </tbody>    
    </table>   

    <a href="../">Back to homepage</a>
</body>
</html>