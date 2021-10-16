<?php require_once '../database.php';

$statement = $conn->prepare('SELECT pi.EID, pi.birthday, pi.citizenship, pi.email, pi.firstName, pi.lastName , pi.postalCode, pi.address, pi.province, pi.city,pw.SSN_Passport, pw.telephone, pw.medicare, w.startDate,w.endDate 
FROM Public_Health_Worker_Id as pw,Public_Health_Worker_Info as pi, Vaccination_Faculty as v, Work_record as w 
WHERE pw.EID=pi.EID AND v.name =:name AND w.EID = pw.EID AND v.address = w.address AND v.city = w.city AND v.province = w.province;
');

$statement->bindParam(':name', $_POST['name']);
$statement->execute();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of workers</title>
    <?php include '../css.php';?>
</head>
<body>
    <h1>Query 19</h1>
    
    <h1>Choose location name</h1>
    <form action="./index.php" method="post">
        <label for="name"></label>name<br/>
        <input type="text" name="name" id="name"> <br/>
        <br>
        <button type="submit">Insert</button>
    </form>
    
    <table border: 1px solid black;>
        <thead>
            <tr>
                <td>EID</td>
                <td>BirthDay</td>
                <td>citizenship</td>
                <td>Email</td>
                <td>First Name</td>
                <td>Last Name</td>
                <td>postalCode</td>
                <td>address</td>
                <td>province</td>
                <td>City</td>
                <td>Phone</td>
                <td>medicare ID</td>
                <td>start Date</td>
                <td>end Date </td>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)){?>
                <tr>
                    <td><?= $row["EID"]?></td>
                    <td><?= $row["birthday"]?></td>
                    <td><?= $row["citizenship"]?></td>
                    <td><?= $row["email"]?></td>
                    <td><?= $row["firstName"]?></td>
                    <td><?= $row["lastName"]?></td>
                    <td><?= $row["postalCode"]?></td>
                    <td><?= $row["address"]?></td>
                    <td><?= $row["province"]?></td>
                    <td><?= $row["city"]?></td>
                    <td><?= $row["SSN_Passport"]?></td>
                    <td><?= $row["phone"]?></td>
                    <td><?= $row["medicare"]?></td>
                    <td><?= $row["startDate"]?></td>
                    <td><?= $row["endDate"]?></td>

                </tr>
            <?php } ?>    
            
        </tbody>    
    </table>   

    <a href="../">Back to homepage</a>
</body>
</html>