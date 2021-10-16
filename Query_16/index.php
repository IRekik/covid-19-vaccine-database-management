<?php require_once '../database.php';

$statement = $conn->prepare('SELECT a.province, a.name, COUNT(*) as sum
                            FROM (
                            	SELECT v.province, v.name, v.SSN_Passport From Vaccination as v 
                            	WHERE v.date >= "2021-01-01" AND v.date <= "2021-07-22"
                            	GROUP BY v.province, v.name, v.SSN_Passport
                                ) as a
                              GROUP BY a.province, a.name;');
$statement->execute();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vaccines per province</title>
    <?php include '../css.php';?>
</head>
<body>
    <h1>Query 16 (Vaccines per province)</h1>
    <table border: 1px solid black;>
        <thead>
            <tr>
                <td>Province</td>
                <td>name</td>
                <td>count</td>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)){?>
                <tr>
                    <td><?= $row["province"]?></td>
                    <td><?= $row["name"]?></td>
                    <td><?= $row["sum"]?></td>

                </tr>
            <?php } ?>    
            
        </tbody>    
    </table>   

    <a href="../">Back to homepage</a>
</body>
</html>