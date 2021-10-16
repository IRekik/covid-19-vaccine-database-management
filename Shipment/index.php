<?php require_once '../database.php';

$statement = $conn->prepare('SELECT *
                            FROM Shipment;');
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
    <h1> Shipment Logs</h1>
    <a href="./ship.php">Ship Vaccines</a>
    <table border: 1px solid black;>
        <thead>
            <tr>
                <td>address</td>
                <td>city</td>
                <td>province</td>
                <td>name</td>
                <td>dateOfReception</td>
                <td>count</td>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)){?>
                <tr>
                    <td><?= $row["address"]?></td>
                    <td><?= $row["city"]?></td>
                    <td><?= $row["province"]?></td>
                    <td><?= $row["name"]?></td>
                    <td><?= $row["dateOfReception"]?></td>
                    <td><?= $row["count"]?></td>

                </tr>
            <?php } ?>    
            
        </tbody>    
    </table>   

    <a href="../">Back to homepage</a>
</body>
</html>