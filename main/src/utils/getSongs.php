<?php
include("./dbConnection.php");

if (isset($_GET['filter'])) {
    $filterTexts = $_GET['filter'];

    $songsFilterQuery = "SELECT songs.id, songs.title title,
                    songs.filePath audio, songs.imgPath img,
                    singers.name singerName, singers.id singerID
                    FROM songs 
                    LEFT JOIN singers on singers.id = songs.singerID
                    WHERE title LIKE '%$filterTexts%' OR singers.name LIKE '%$filterTexts%'";

    $result = mysqli_query($conn, $songsFilterQuery);
    $songs = mysqli_fetch_all($result, MYSQLI_ASSOC);

    echo json_encode($songs);
}
