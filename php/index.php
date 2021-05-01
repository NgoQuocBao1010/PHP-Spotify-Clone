<?php
include("./utils/getUrl.php");

include("./utils/dbConnection.php");

$getAllSongsQuery = "SELECT Songs.id, Songs.title title, Singers.name singerName, 
                              Songs.filePath audio, Songs.imgPath img
                    FROM Songs 
                    LEFT JOIN Singers on Singers.id = Songs.singerID
                    ORDER BY Songs.dateAdded DESC";


$result = mysqli_query($conn, $getAllSongsQuery);
$songs = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Generate random songs
$randomKeys = array_rand($songs, 3);

$test = array();

foreach ($songs as $song) {
    $test[$song["id"]] = $song;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <link rel="stylesheet" href="style.css">
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
            <!-- End Music UI -->
        </div>
        <!-- Music Player -->
        <?php include("./components/musicPlayer.php"); ?>
    </div>
</body>
<?php include("./utils/changePageJs.php"); ?>
<script>
    let songDetails = JSON.parse('<?php echo json_encode($test); ?>');
</script>
<script src="main.js"></script>
<script>
    // const musicUI = document.querySelector(".musicContainer");
    // console.log(musicUI.innerHTML);
</script>

</html>