<?php
$singerName = $singerInfo = $singerImg = "";
if (isset($_GET['singerID'])) {
    $singerID = $_GET['singerID'];

    $singerFilterQuery = "SELECT *
                    FROM singers 
                    WHERE id=$singerID";

    $result = mysqli_query($conn, $singerFilterQuery);
    $singer = mysqli_fetch_all($result, MYSQLI_ASSOC);

    if (count($singer) > 0) {
        $singerName = $singer[0]["name"];
        $singerInfo = $singer[0]["info"];
        $singerImg = $singer[0]["image"];

        $songsQuery =  "SELECT songs.id, songs.title title,
                        songs.filePath audio, songs.imgPath img,
                        singers.name singerName, singers.id singerID
                    FROM songs 
                    LEFT JOIN singers on singers.id = songs.singerID
                    WHERE singers.id = $singerID
                    ORDER BY songs.dateAdded DESC";

        $result2 = mysqli_query($conn, $songsQuery);
        $songs = mysqli_fetch_all($result2, MYSQLI_ASSOC);
    } else {
        redirect("404.php");
    }
}
?>
<?php include('./components/navbar.php'); ?>
<div class="cover">
    <img src="<?php echo $singerImg; ?>" alt="" />
    <div class="coverDetail">
        <h1>
            <?php echo $singerName; ?>
        </h1>
        <div class="pulse"></div>
    </div>
</div>
<div class="products">
    <h1>All Songs</h1>
    <?php foreach ($songs as $index => $song) : ?>
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
                <i class="far fa-heart"></i>
                <i class="fas fa-list-ul"></i>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<div class="description">
    <h2 class="title">Introduction</h2>
    <div class="desDetail">
        <img src="<?php echo $singerImg; ?>" alt="" />
        <p><?php echo $singerInfo; ?></p>
    </div>
</div>