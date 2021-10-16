<?php require_once '../database.php';

$statement = $conn->prepare('SELECT v.city,SUM(DISTINCT v.SSN_Passport) as sum
FROM Vaccination as v 
WHERE v.province ="QC" AND v.date > "2020-12-31" AND v.date < "2021-07-23" 
GROUP BY v.city;');
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
    <h1>Query 17</h1>
    <table border: 1px solid black;>
        <thead>
            <tr>
                <td>City</td>
                <td>Sum</td>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)){?>
                <tr>
                    <td><?= $row["city"]?></td>
                    <td><?= $row["sum"]?></td>

                </tr>
            <?php } ?>    
            
        </tbody>    
    </table>   

    <a href="../">Back to homepage</a>
</body>
</html>