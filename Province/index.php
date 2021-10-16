<?php require_once '../database.php';

$statement = $conn->prepare('SELECT * 
                            FROM Province_priority;');
$statement->execute();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Province</title>
    <?php include '../css.php';?>
</head>
<body>
    <h1>List of provinces</h1>
    <a href="./create.php">Insert a province</a>
    <table border: 1px solid black;>
        <thead>
            <tr>
                <td>provincialCode</td>
                <td>Actions</td>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)){?>
                <tr>
                    <td><?= $row["provincialCode"]?></td>

                    <td>
                        <a href="./delete.php?provincialCode=<?= $row["provincialCode"]?>">Delete</a>
                        <a href="./edit.php?provincialCode=<?= $row["provincialCode"]?>">Edit</a>
                    </td>

                </tr>
            <?php } ?>    
            
        </tbody>    
    </table>   
    <a href="./newAge.php">Change province group age</a> <br>           
    <a href="../">Back to homepage</a>
</body>
</html>