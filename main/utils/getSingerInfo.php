<?php
include("./dbConnection.php");
if (isset($_GET['singerID'])) {
    $singerID = $_GET['singerID'];

    $singerFilterQuery = "SELECT *
                    FROM Singers 
                    WHERE id=$singerID";

    $result = mysqli_query($conn, $singerFilterQuery);
    $singer = mysqli_fetch_array($result, MYSQLI_ASSOC);

    $songsQuery =  "SELECT Songs.id, Songs.title title,
                        Songs.filePath audio, Songs.imgPath img,
                        Singers.name singerName, Singers.id singerID
                    FROM Songs 
                    LEFT JOIN Singers on Singers.id = Songs.singerID
                    WHERE Singers.id = $singerID
                    ORDER BY Songs.dateAdded DESC";

    $result2 = mysqli_query($conn, $songsQuery);
    $songs = mysqli_fetch_all($result2, MYSQLI_ASSOC);

    $singer["songs"] = $songs;

    echo json_encode($singer);
}
