<?php require_once '../database.php';

$statement = $conn->prepare('SELECT Public_Health_Worker_Info.firstName, Public_Health_Worker_Info.lastName, Public_Health_Worker_Info.birthday, Public_Health_Worker_Info.email, Public_Health_Worker_Id.telephone, Public_Health_Worker_Info.city, Public_Health_Worker_Info.EID  
                            FROM Public_Health_Worker_Info,Public_Health_Worker_Id
                            WHERE Public_Health_Worker_Info.EID = Public_Health_Worker_Id.EID;');
$statement->execute();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Public Health Workers</title>
    <?php include '../css.php';?>
</head>
<body>
    <h1>List of people</h1>
    <a href="./create.php">Insert new worker</a>
    <table border: 1px solid black;>
        <thead>
            <tr>
                <td>fName</td>
                <td>lName</td>
                <td>birthday</td>
                <td>email</td>
                <td>telephone</td>
                <td>city</td>
                <td>Actions</td>
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
                    <td>
                        <a href="./delete.php?EID=<?= $row['EID']?>">Delete</a>
                        <a href="./edit.php?EID=<?= $row['EID']?>">Edit</a>
                    </td>
                </tr>
            <?php } ?>    
            
        </tbody>    
    </table>   

    <a href="../">Back to homepage</a>
</body>
</html>