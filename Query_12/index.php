<?php require_once '../database.php';

$statement = $conn->prepare('SELECT distinct firstName, Person_info.lastName, Person_info.birthday, Person_info.email, Medicare.telephone, Person_info.city, Vaccination.date, Vaccination.typeOfVaccine
FROM Person_info, Medicare, Vaccination, Infection, GroupAge , Infected 
WHERE Person_info.SSN_Passport = Medicare.SSN_Passport AND Person_info.SSN_Passport = GroupAge.SSN_Passport AND Person_info.SSN_Passport = Vaccination.SSN_Passport AND GroupAge.groupNumber >= 1 AND GroupAge.groupNumber <= 3 
AND Vaccination.doseNumber = 1;');
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
    <h1>Query 12</h1>
    <table border: 1px solid black;>
        <thead>
            <tr>
                <td>First Name</td>
                <td>Last Name</td>
                <td>BirthDay</td>
                <td>Email</td>
                <td>Phone</td>
                <td>City</td>
                <td>Date of Vaccination</td>
                <td>Vaccination Type</td>

            </tr>
        </thead>
        <tbody>
            <?php while ($row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)){?>
                <tr>
                    <td><?= $row["firstName"]?></td>
                    <td><?= $row["lastName"]?></td>
                    <td><?= $row["birthday"]?></td>
                    <td><?= $row["email"]?></td>
                    <td><?= $row["telephone"]?></td>
                    <td><?= $row["city"]?></td>
                    <td><?= $row["date"]?></td>
                    <td><?= $row["typeOfVaccine"]?></td>



                </tr>
            <?php } ?>    
            
        </tbody>    
    </table>   

    <a href="../">Back to homepage</a>
</body>
</html>