<?php require_once '../database.php';

$statement = $conn->prepare('SELECT g.id, g.ageMin, g.ageMAx
                            FROM Priority_Groups as g;');
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
    <h1>List of priority groups</h1>
    <a href="./create.php">Insert new PG</a>
    <table border: 1px solid black;>
        <thead>
            <tr>
                <td>id</td>
                <td>Minimum Age</td>
                <td>Maximum Age</td>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)){?>
                <tr>
                    <td><?= $row["id"]?></td>
                    <td><?= $row["ageMin"]?></td>
                    <td><?= $row["ageMAx"]?></td>

                    <td>
                        <a href="./delete.php?id=<?= $row["id"]?>">Delete</a>
                        <a href="./edit.php?id=<?= $row["id"]?>">Edit</a>
                    </td>

                </tr>
            <?php } ?>    
            
        </tbody>    
    </table>   

    <a href="../">Back to homepage</a>
</body>
</html>