<?php require_once '../database.php';

$statement = $conn->prepare('SELECT i.province, v.type , v.name, SUM(i.numOfVaccines) AS sum 
FROM Inventory as i, Vaccines as v 
WHERE i.name = v.name 
GROUP BY i.province, v.name 
ORDER BY i.province ASC, SUM(i.numOfVaccines) DESC; ');
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
    <h1>Query 15</h1>
    <table border: 1px solid black;>
        <thead>
            <tr>
                <td>Province</td>
                <td>Type</td>
                <td>Name</td>
                <td>Sum</td>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)){?>
                <tr>
                    <td><?= $row["province"]?></td>
                    <td><?= $row["type"]?></td>
                    <td><?= $row["name"]?></td>
                    <td><?= $row["sum"]?></td>

                </tr>
            <?php } ?>    
            
        </tbody>    
    </table>   

    <a href="../">Back to homepage</a>
</body>
</html>