<?php require_once '../database.php';

$statement = $conn->prepare('SELECT v.address, v.name, v.webAddress, v.type, v.phone, v.province, v.city
                            FROM Vaccination_Faculty as v;');
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
    <h1>List of Facilities</h1>
    <a href="./create.php">Insert new Facility</a>
    <table border: 1px solid black;>
        <thead>
            <tr>
                <td>address</td>
                <td>name</td>
                <td>webAddress</td>
                <td>type</td>
                <td>phone</td>
                <td>province</td>
                <td>city</td>
                <td>Actions</td>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)){?>
                <tr>
                    <td><?= $row["address"]?></td>
                    <td><?= $row["name"]?></td>
                    <td><?= $row["webAddress"]?></td>
                    <td><?= $row["type"]?></td>
                    <td><?= $row["phone"]?></td>
                    <td><?= $row["province"]?></td>
                    <td><?= $row["city"]?></td>
                    <td>
                        <a href="./delete.php?address=<?= $row["address"]?>&city=<?= $row["city"]?>&province=<?= $row["province"]?>">Delete</a>
                        <a href="./edit.php?address=<?= $row["address"]?>&city=<?= $row["city"]?>&province=<?= $row["province"]?>">Edit</a>
                    </td>

                </tr>
            <?php } ?>    
            
        </tbody>    
    </table>   

    <a href="../">Back to homepage</a>
</body>
</html>