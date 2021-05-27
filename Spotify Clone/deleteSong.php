<?php
    include ("connection.php");
    $id = $_GET['id'];
              
    $sql = "DELETE FROM songs WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    if ($result) header("Location: editSong.php");
?>