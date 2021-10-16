<?php require_once '../database.php';

$statement = $conn->prepare('SELECT * 
                            FROM Covid;');
$statement->execute();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Covid Variants</title>
    <?php include '../css.php';?>
</head>
<body>
    <h1>List of variants</h1>
    <a href="./create.php">Insert new variant</a>
    <table border: 1px solid black;>
        <thead>
            <tr>
                <td>type</td>
                <td>Actions</td>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)){?>
                <tr>
                    <td><?= $row["type"]?></td>

                    <td>
                        <a href="./delete.php?type=<?= $row["type"]?>">Delete</a>
                        <a href="./edit.php?type=<?= $row["type"]?>">Edit</a>
                    </td>

                </tr>
            <?php } ?>    
            
        </tbody>    
    </table>   

    <a href="../">Back to homepage</a>
</body>
</html>