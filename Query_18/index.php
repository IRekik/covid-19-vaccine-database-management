<?php require_once '../database.php';

$statement = $conn->prepare('SELECT vf.name,vf.address,vf.type,vf.phone, count(*) as NbrWorker
FROM Vaccination_Faculty as vf, Work_record as wr
WHERE vf.city = "Montreal" and vf.city = wr.city and vf.address = wr.address and vf.province = wr.province
group by vf.province, vf.address, vf.city;');
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
    <h1>Faculties in montreal</h1>
    <table border: 1px solid black;>
        <thead>
            <tr>
                <td>name</td>
                <td>address</td>
                <td>BirthDay</td>
                <td>type</td>
                <td>phone</td>
                <td>NbrWorker</td>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)){?>
                <tr>
                    <td><?= $row["name"]?></td>
                    <td><?= $row["address"]?></td>
                    <td><?= $row["birthday"]?></td>
                    <td><?= $row["type"]?></td>
                    <td><?= $row["phone"]?></td>
                    <td><?= $row["NbrWorker"]?></td>



                </tr>
            <?php } ?>    
            
        </tbody>    
    </table>   

    <a href="../">Back to homepage</a>
</body>
</html>