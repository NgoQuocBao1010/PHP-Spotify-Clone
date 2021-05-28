<?php
include("connection.php");
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="dashboard">
        <div class="icon-dashboard">
            <label>USERS</label>
            <a href="testUpdate.php"><i class="fas fa-users fa-7x"></i></a>
        </div>

        <div class="icon-dashboard">
            <label>SONGS</label>
            <a href="editSong.php"><i class="fas fa-music fa-7x"></i></a>
        </div>

        <div class="icon-dashboard">
            <label>SINGERS</label>
            <a href="editSinger.php"><i class="fas fa-microphone fa-7x"></i></a>
        </div>

    </div>



</body>
<script src="https://kit.fontawesome.com/6e6c14e530.js" crossorigin="anonymous"></script>

</html>