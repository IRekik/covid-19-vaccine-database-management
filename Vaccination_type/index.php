<?php require_once '../database.php';

$statement = $conn->prepare('SELECT Vaccines.name, Vaccines.dateOfApproval, Vaccines.type, Vaccines.dateOfSuspension
                            FROM Vaccines;');
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
    <h1>List of vaccination types</h1>
    <a href="./create.php">Insert new vaccine</a>
    <table border: 1px solid black;>
        <thead>
            <tr>
                <td>name</td>
                <td>date of approval</td>
                <td>type</td>
                <td>date of suspension</td>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)){?>
                <tr>
                    <td><?= $row["name"]?></td>
                    <td><?= $row["dateOfApproval"]?></td>
                    <td><?= $row["type"]?></td>
                    <td><?= $row["dateOfSuspension"]?></td>
                    <td>
                        <a href="./delete.php?name=<?= $row["name"]?>">Delete</a>
                        <a href="./edit.php?name=<?= $row["name"]?>">Edit</a>
                    </td>

                </tr>
            <?php } ?>    
            
        </tbody>    
    </table>   

    <a href="../">Back to homepage</a>
</body>
</html>