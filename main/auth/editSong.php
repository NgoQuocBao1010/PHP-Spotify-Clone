<?php
include('./auth.php');

if (!$authenticated) {
    header("Location: ./login.php");
} else {
    if (!$admin) {
        header("Location: ./unauth.php");
    }
}

include("../utils/dbConnection.php");
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
    <link rel="stylesheet" href="editSong.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <div class="link">
        <a class="ca2" href="adminDashboard.php">BACK</a>
        <a class="ca2" style="margin-top:5px;" href=insertSong.php><i class="fa fa-plus"></i></a>
    </div>

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


        <?php foreach ($songs as $index => $song) : ?>
            <tr>
                <td><?php echo $index + 1; ?></td>
                <td><img style="width: 50px; height: 50px;" src="<?php echo '../' . $song['imgPath'] ?>"></td>
                <td><?php echo $song['title']; ?></td>
                <td><?php echo $song['filePath']; ?></td>
                <td><a style="padding: 5px; background-color: #66FF33; color: #fff; border-radius: 15px; text-decoration: none;" href="insertSong.php?id=<?php echo $song['id'] ?>">Update</a></td>
                <td><a style="padding: 5px; background-color: #E3242B; color: #fff; border-radius: 15px; text-decoration: none;" href="deleteSong.php?id=<?php echo $song['id'] ?>">Delete</a></td>
            </tr>
        <?php endforeach; ?>


    </table>
</body>

</html>