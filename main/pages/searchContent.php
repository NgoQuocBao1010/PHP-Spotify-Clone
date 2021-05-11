<?php
if (isset($_GET['search'])) {
    $filterTexts = $_GET['search'];
    // Get songs from database
    $songsFilterQuery = "SELECT Songs.id, Songs.title title, Singers.name singerName, 
                        Songs.filePath audio, Songs.imgPath img, Singers.id singerID
                        FROM Songs 
                        LEFT JOIN Singers on Singers.id = Songs.singerID
                        WHERE title LIKE '%$filterTexts%' OR Singers.name LIKE '%$filterTexts%'";

    $result = mysqli_query($conn, $songsFilterQuery);
    $songs = mysqli_fetch_all($result, MYSQLI_ASSOC);
}

?>
<?php include('./components/navbar.php'); ?>
<section>
    <h3 class="sectionTitle">Songs</h3>
    <div class="songsContain">
        <?php foreach ($songs as $index => $song) : ?>
            <div class="song" data="<?php echo $song['id']; ?>">
                <div class="info">
                    <h4><?php echo $index + 1; ?> </h4>
                    <img src="<?php echo $song['img']; ?>">
                    <div class="detail">
                        <h4><?php echo $song['title']; ?></h4>
                        <h5 class="singerPage" data-singer="<?php echo $song["singerID"]; ?>"><?php echo $song['singerName']; ?></h5>
                    </div>
                </div>
                <div class="func">
                    <i class="far fa-heart"></i>
                    <i class="fas fa-list-ul"></i>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>