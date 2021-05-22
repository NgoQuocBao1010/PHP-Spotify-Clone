<?php
include ("connection.php");
$sql = "SELECT * FROM singers";
$result = mysqli_query($conn, $sql);
$singers = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Singer</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<table align="center" border="2" style="width:600px; line-height:40px; color: white;">
        <tr>
            <th colspan="6">Singers Info</th>
        </tr>
        <tr>
            <th>STT</th>
            <th>Name</th>
            <th>Info</th>
            <th colspan="3">Operations</th>
        </tr>
    

        <?php foreach ($singers as $index => $singer): ?>
        <tr>
            <td><?php echo $index + 1; ?></td>
            <td><?php echo $singer['name']; ?></td>
            <td><?php echo $singer['info']; ?></td>
            
            <td><a href=updateSinger.php?id=<?php echo $singer['id']?>>Update</a></td>
            <td><a href="delete.php?id=<?php echo $singer['id'] ?>">Delete</a></td>
        </tr>
        <?php endforeach; ?>

            
    </table>
    <a href=insertSinger.php>Insert</a>
</body>
</html>