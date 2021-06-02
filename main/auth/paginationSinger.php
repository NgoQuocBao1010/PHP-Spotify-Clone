<?php

include("../utils/dbConnection.php");
$sql = "SELECT * FROM singers";
$result = mysqli_query($conn, $sql);
$songs = mysqli_fetch_all($result, MYSQLI_ASSOC);
    
$start = ($_REQUEST['page']-1)*5;
    $end = ($start + 5);
$listSinger = array();

    foreach ($songs as $index => $song){
        if($start <= $index && $index < $end){
            array_push ($listSinger, $song);
        }
    }
    echo json_encode($listSinger, JSON_UNESCAPED_UNICODE);

?>