<?php
// $filterTexts = '';
// // Get songs from database
// $songsFilterQuery = "SELECT Songs.id, Songs.title title, Singers.name singerName, 
//                     Songs.filePath audio, Songs.imgPath img
//                     FROM Songs 
//                     LEFT JOIN Singers on Singers.id = Songs.singerID
//                     WHERE title LIKE '%$filterTexts%' OR Singers.name LIKE '%$filterTexts%'";

// $result = mysqli_query($conn, $songsFilterQuery);
// $songs = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
<section>
    <div class="searchContainer">
        <div class="searchBox">
            <input type="text" name="search" spellcheck="false" class="search" placeholder="Artists, songs...">
            <div class="icon">
                <i class="fas fa-search"></i>
            </div>
        </div>
    </div>
</section>
<section>
    <h3 class="sectionTitle">Songs</h3>
    <div class="songsContain">
        <?php foreach ($songs as $index => $song) : ?>
            <div class="song" data="<?php echo $song['id']; ?>">
                <div class="info">
                    <h4><?php echo $index + 1; ?> </h4>
                    <img src="<?php echo $song['img']; ?>">
                    <h4><?php echo $song['title']; ?></h4>
                </div>
                <div class="func">
                    <i class="far fa-heart"></i>
                    <h4>3:01</h4>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>