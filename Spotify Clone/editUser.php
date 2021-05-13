<?php
include ("connection.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <table align="center" border="2" style="width:600px; line-height:40px; color: white;">
        <tr>
            <th colspan="6">User Info</th>
        </tr>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Name</th>
            <th>GroupId</th>
            <th colspan="2">Operations</th>
        </tr>
    

        <?php  
        $sql = "SELECT * FROM users";
        $result = mysqli_query($conn, $sql);
        
        while($row = mysqli_fetch_array($result))
            {
        ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['username']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['groupID']; ?></td>
                <td><a href=updateUsers.php?id=<?php echo $row['id']?>>Update</a></td>
                <td><a href="#">Delete</a></td>
            </tr>
        <?php
        }
        ?>
            
    </table>
</body>
</html>