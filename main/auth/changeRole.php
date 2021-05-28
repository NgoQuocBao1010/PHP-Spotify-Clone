<?php
include("../utils/dbConnection.php");
if (isset($_GET['uid'])) {
    $userID = $_GET['uid'];
    $groupID = $_GET['admin'];


    $updateSql = "UPDATE users SET groupID=$groupID WHERE id=$userID";
    $result1 = mysqli_query($conn, $updateSql);
    if ($result1) {
        echo "Successful update user $userID";
    } else {
        echo "Error when update user $userID";
    }
}
