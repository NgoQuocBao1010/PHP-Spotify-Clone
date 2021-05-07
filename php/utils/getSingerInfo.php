<?php
include("./dbConnection.php");
if (isset($_GET['singerID'])) {
    $singerID = $_GET['singerID'];

    $singerFilterQuery = "SELECT *
                    FROM Singers 
                    WHERE id=$singerID";

    $result = mysqli_query($conn, $singerFilterQuery);
    $singer = mysqli_fetch_all($result, MYSQLI_ASSOC);

    $songsQuery =  "SELECT Songs.id, Songs.title title,
                        Songs.filePath audio, Songs.imgPath img,
                        Singers.name singerName, Singers.id singerID
                    FROM Songs 
                    LEFT JOIN Singers on Singers.id = Songs.singerID
                    WHERE Singers.id = $singerID
                    ORDER BY Songs.dateAdded DESC";

    $result2 = mysqli_query($conn, $songsQuery);
    $songs = mysqli_fetch_all($result2, MYSQLI_ASSOC);

    $test = "<h1>All Songs</h1>";
    $songids = array();
    if (count($songs) > 0) {
        foreach ($songs as $index => $song) {
            $test = $test . "<div class='song' data='" . $song['id'] . "'>";
            $test = $test .    '<div class="info">';
            $test = $test .        "<h4>" . $index + 1 . "</h4>";
            $test = $test .        '<img src="' . $song['img'] . '">';
            $test = $test .        '<div class="detail">';
            $test = $test .            '<h4>' . $song['title'] . '</h4>';
            $test = $test .            '<h5 data-singer="' . $song['singerID'] . '">' . $song['singerName'] . '</h5>';
            $test = $test .        '</div>';
            $test = $test .    '</div>';
            $test = $test .     '<div class="func">';
            $test = $test .        '<i class="far fa-heart"></i>';
            $test = $test .        '<i class="fas fa-list-ul"></i>';
            $test = $test .    '</div>';
            $test = $test .  '</div>';
            array_push($songids, $song['id']);
        }
    } else {
        echo "<h1>No songs found</h1>";
    }

    $singer[0]["songs"] = $test;
    $singer[0]["songids"] = $songids;

    echo json_encode($singer);
}
