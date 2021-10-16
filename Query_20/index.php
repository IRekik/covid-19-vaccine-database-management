<?php require_once '../database.php';

$statement = $conn->prepare('SELECT pw.EID,pw.firstName,pw.lastName,pw.birthday,pi.telephone,pw.city,pw.email
FROM Public_Health_Worker_Info as pw,Public_Health_Worker_Id as pi, Vaccination v
WHERE (pw.EID = pi.EID AND NOT(v.SSN_Passport = pi.SSN_Passport)) or 
(pw.EID = pi.EID AND v.SSN_Passport = pi.SSN_Passport AND doseNumber<2)
group by EID;');
$statement->execute();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anti-Vaxxers health workers</title>
    <?php include '../css.php';?>
</head>
<body>
    <h1>Query 20 (Non vaccinated workers)</h1>
    <table border: 1px solid black;>
        <thead>
            <tr>
                <td>EID</td>
                <td>First Name</td>
                <td>Last Name</td>
                <td>BirthDay</td>
                <td>Phone</td>
                <td>City</td>
                <td>Email</td>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)){?>
                <tr>
                    <td><?= $row["EID"]?></td>
                    <td><?= $row["firstName"]?></td>
                    <td><?= $row["lastName"]?></td>
                    <td><?= $row["birthday"]?></td>
                    <td><?= $row["telephone"]?></td>
                    <td><?= $row["city"]?></td>
                    <td><?= $row["email"]?></td>
                    

                </tr>
            <?php } ?>    
            
        </tbody>    
    </table>   

    <a href="../">Back to homepage</a>
</body>
</html>