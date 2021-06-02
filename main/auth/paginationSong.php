<?php

include("../utils/dbConnection.php");
$sql = "SELECT * FROM songs";
$result = mysqli_query($conn, $sql);
$songs = mysqli_fetch_all($result, MYSQLI_ASSOC);
    
$start = ($_REQUEST['page']- 1)*5;
    $end = ($start + 5);
$listSong = array();

    foreach ($songs as $index => $song){
        if($start <= $index && $index < $end){
            array_push ($listSong, $song);
        }
    }
    echo json_encode($listSong, JSON_UNESCAPED_UNICODE);

?>