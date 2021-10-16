<?php require_once '../database.php';

$statement = $conn->prepare('SELECT Person_info.firstName, Person_info.lastName, Person_info.birthday, Person_info.email, Medicare.telephone, Person_info.city, Person_info.SSN_Passport 
                            FROM Person_info,Medicare
                            WHERE Person_info.SSN_Passport = Medicare.SSN_Passport;');
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
    <h1>List of people</h1>
    <a href="./create.php">Insert new person</a>
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
                        <a href="./delete.php?SSN_Passport=<?= $row["SSN_Passport"]?>">Delete</a>
                        <a href="./edit.php?SSN_Passport=<?= $row["SSN_Passport"]?>">Edit</a>
                    </td>

                </tr>
            <?php } ?>    
            
        </tbody>    
    </table>   

    <a href="../">Back to homepage</a>
</body>
</html>