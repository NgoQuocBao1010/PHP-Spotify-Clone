<?php
include("./dbConnection.php");
if (isset($_GET['singerID'])) {
    $singerID = $_GET['singerID'];

    $singerFilterQuery = "SELECT *
                    FROM singers 
                    WHERE id=$singerID";

    $result = mysqli_query($conn, $singerFilterQuery);
    $singer = mysqli_fetch_array($result, MYSQLI_ASSOC);

    $songsQuery =  "SELECT songs.id, songs.title title,
                        songs.filePath audio, songs.imgPath img,
                        singers.name singerName, singers.id singerID
                    FROM songs 
                    LEFT JOIN singers on singers.id = songs.singerID
                    WHERE singers.id = $singerID
                    ORDER BY songs.dateAdded DESC";

    $result2 = mysqli_query($conn, $songsQuery);
    $songs = mysqli_fetch_all($result2, MYSQLI_ASSOC);

    $singer["songs"] = $songs;

    echo json_encode($singer);
}
