<?php
include ("connection.php");
$sql = "SELECT * FROM songs";
$result = mysqli_query($conn, $sql);
$songs = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Song</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<a class="ca2" href="adminDashboard.php">BACK</a>
<table align="center" border="2" style="width:600px; line-height:40px; color: white;">
        <tr>
            <th colspan="6">Singers Info</th>
        </tr>
        <tr>
            <th>STT</th>
            <th>Images</th>
            <th>Name</th>
            <th>Music File</th>
            <th colspan="3">Operations</th>
        </tr>
    

        <?php foreach ($songs as $index => $song): ?>
        <tr>
            <td><?php echo $index + 1; ?></td>
            <td><img style="width: 50px; height: 50px;" src="<?php echo $song['imgPath'] ?>"></td>
            <td><?php echo $song['title']; ?></td>
            <td><?php echo $song['filePath']; ?></td>
            <td><a href="insertSong.php?id=<?php echo $song['id']?>">Update</a></td>
            <td><a href="deleteSinger.php?id=<?php echo $song['id'] ?>">Delete</a></td>
        </tr>
        <?php endforeach; ?>

            
    </table>
    <a href=insertSong.php>Insert</a>
</body>
</html>