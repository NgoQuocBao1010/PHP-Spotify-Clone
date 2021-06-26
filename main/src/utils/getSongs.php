<?php
include("./dbConnection.php");

if (isset($_GET['filter'])) {
    $filterTexts = $_GET['filter'];

    $songsFilterQuery = "SELECT Songs.id, Songs.title title,
                    Songs.filePath audio, Songs.imgPath img,
                    Singers.name singerName, Singers.id singerID
                    FROM Songs 
                    LEFT JOIN Singers on Singers.id = Songs.singerID
                    WHERE title LIKE '%$filterTexts%' OR Singers.name LIKE '%$filterTexts%'";

    $result = mysqli_query($conn, $songsFilterQuery);
    $songs = mysqli_fetch_all($result, MYSQLI_ASSOC);

    echo json_encode($songs);
}
