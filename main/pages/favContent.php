<?php

$favSongsQuery =  "SELECT Songs.id, Songs.title title,
                        Songs.filePath audio, Songs.imgPath img,
                        Singers.name singerName, Singers.id singerID
                    FROM Songs 
                    LEFT JOIN Singers on Singers.id = Songs.singerID
                    LEFT JOIN Favourites on Favourites.songID = Songs.id
                    WHERE Favourites.uid = $uid
                    ORDER BY Songs.dateAdded DESC";

$result = mysqli_query($conn, $favSongsQuery);
$favSongs = mysqli_fetch_all($result, MYSQLI_ASSOC);

$songsQuery =  "SELECT Songs.id, Songs.title title,
                        Songs.filePath audio, Songs.imgPath img,
                        Singers.name singerName, Singers.id singerID
                    FROM Songs 
                    LEFT JOIN Singers on Singers.id = Songs.singerID
                    LEFT JOIN Favourites on Favourites.songID = Songs.id
                    WHERE Favourites.uid = $uid
                    ORDER BY Songs.dateAdded DESC";
?>
<?php include('./components/navbar.php'); ?>
<div class="fav">
    <h1>Favourites Songs</h1>
    <?php foreach ($favSongs as $index => $song) : ?>
        <div class="song" data="<?php echo $song['id']; ?>">
            <div class="info">
                <h4><?php echo $index + 1; ?> </h4>
                <img src="<?php echo $song['img']; ?>">
                <div class="detail">
                    <h4><?php echo $song['title']; ?></h4>
                    <h5 data-singer="<?php echo $song["singerID"]; ?>"><?php echo $song['singerName']; ?></h5>
                </div>
            </div>
            <div class="func">
                <i class="fas fa-trash"></i>
                <i class="fas fa-list-ul"></i>
            </div>
        </div>
    <?php endforeach; ?>
</div>