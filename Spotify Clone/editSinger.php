<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
}
include("connection.php");
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
    <div class="link">
        <a class="ca2" href="adminDashboard.php">BACK</a>
        <a class="ca2" style="margin-top:5px;" href=insertSinger.php>INSERT</a>
    </div>

    <table id="customers" align="center" border="1">
        <tr>
            <th colspan="6">Songs Info</th>
        </tr>
        <tr>
            <th>STT</th>
            <th>Images</th>
            <th>Name</th>
            <th>Info</th>
            <th colspan="3">Operations</th>
        </tr>


        <?php foreach ($singers as $index => $singer) : ?>
            <tr>
                <td><?php echo $index + 1; ?></td>
                <td><img style="width: 50px; height: 50px;" src="<?php echo $singer['image'] ?>"></td>
                <td><?php echo $singer['name']; ?></td>
                <td><?php echo $singer['info']; ?></td>
                <td><a style="padding: 5px; background-color: #66FF33; color: #fff; border-radius: 15px; text-decoration: none;" href="insertSinger.php?id=<?php echo $singer['id'] ?>"><strong>Update</strong></a></td>
                <td><a style="padding: 5px; background-color: #E3242B; color: #fff; border-radius: 15px; text-decoration: none;" href="deleteSinger.php?id=<?php echo $singer['id'] ?>"><strong>Delete</strong></a></td>
            </tr>
        <?php endforeach; ?>

    </table>
    
</body>

</html>