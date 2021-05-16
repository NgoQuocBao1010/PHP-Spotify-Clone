<?php
include ("connection.php");
$sql = "SELECT * FROM users";
$result = mysqli_query($conn, $sql);
$users = mysqli_fetch_all($result, MYSQLI_ASSOC);
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
            <th>STT</th>
            <th>Username</th>
            <th>Name</th>
            <th>GroupId</th>
            <th colspan="2">Operations</th>
        </tr>
    

        <?php foreach ($users as $index => $user): ?>
        <tr>
            <td><?php echo $index + 1; ?></td>
            <td><?php echo $user['username']; ?></td>
            <td><?php echo $user['name']; ?></td>
            <td><?php echo $user['groupID']; ?></td>
            <td><a href=updateUsers.php?id=<?php echo $user['id']?>>Update</a></td>
            <td><a href="delete.php?id=<?php echo $user['id'] ?>">Delete</a></td>
        </tr>
        <?php endforeach; ?>



            
    </table>
</body>
</html>