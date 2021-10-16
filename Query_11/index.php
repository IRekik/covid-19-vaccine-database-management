<?php require_once '../database.php';

$statement = $conn->prepare('SELECT v.SSN_Passport, p.firstName, p.lastName, v.name ,v.date, v.doseNumber , v.EID
                            FROM Vaccination as v, Person_info as p
                            WHERE v.SSN_Passport=p.SSN_Passport;');
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
    <h1>List of vaccination</h1>
    <a href="./Vaccinate.php">Add a vaccinated person</a>
    <table border: 1px solid black;>
        <thead>
            <tr>
                <td>SSN\Passport</td>
                <td>First Name</td>
                <td>Last Name</td>
                <td>Vaccine Name</td>
                <td>Vaccination Date</td>
                <td>Dose Number</td>
                <td>Employee ID</td>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)){?>
                <tr>
                    <td><?= $row["SSN_Passport"]?></td>
                    <td><?= $row["firstName"]?></td>
                    <td><?= $row["lastName"]?></td>
                    <td><?= $row["name"]?></td>
                    <td><?= $row["date"]?></td>
                    <td><?= $row["doseNumber"]?></td>
                    <td><?= $row["EID"]?></td>

                </tr>
            <?php } ?>    
            
        </tbody>    
    </table>   

    <a href="../">Back to homepage</a>
</body>
</html>