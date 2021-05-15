<?php
    include ("connection.php");
    $id = $_GET['id'];
              
    $sql = "DELETE FROM users WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    if ($result) header("Location: editUser.php");
?>