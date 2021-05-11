<?php
include("./utils/getUrl.php");

include("./utils/dbConnection.php");

function redirect($url)
{
    echo "<script type='text/javascript'>document.location.href='{$url}';</script>";
    echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $url . '">';
}

$getAllSongsQuery = "SELECT Songs.id, Songs.title title,
                            Songs.filePath audio, Songs.imgPath img,
                            Singers.name singerName, Singers.id singerID
                    FROM Songs 
                    LEFT JOIN Singers on Singers.id = Songs.singerID
                    ORDER BY Songs.dateAdded DESC";


$result = mysqli_query($conn, $getAllSongsQuery);
$songs = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Generate random songs
$randomKeys = (count($songs) >= 3) ? array_rand($songs, 3) : $songs;

$formatSongs = array();

foreach ($songs as $song) {
    $formatSongs[$song["id"]] = $song;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/homePage.css">
    <link rel="stylesheet" href="./css/singerPage.css">
    <link rel="stylesheet" href="./css/searchPage.css">
    <link href='https://css.gg/home.css' rel='stylesheet'>
    <title>Spotify</title>
</head>

<body>
    <div class="container">
        <div class="content">
            <!-- Sidebar -->
            <?php include("./components/sidebar.php"); ?>
            <!-- End sidebar -->

            <!-- Music UI -->
            <div class="musicContainer" id="home">
                <?php include("./pages/homeContent.php"); ?>
            </div>
            <div class="musicContainer hide" id="search">
                <?php include("./pages/searchContent.php"); ?>
            </div>
            <div class="musicContainer hide" id="singer">
                <?php include("./pages/singerContent.php"); ?>
            </div>
            <!-- End Music UI -->
        </div>
        <!-- Music Player -->
        <?php include("./components/musicPlayer.php"); ?>
    </div>
</body>
<script>
    let songDetails = JSON.parse('<?php echo json_encode($formatSongs); ?>');
</script>
<script src="main.js"></script>
<?php include("./utils/changePageJs.php"); ?>
<script>
    // const musicUI = document.querySelector(".musicContainer");
    // console.log(musicUI.innerHTML);
</script>

</html>