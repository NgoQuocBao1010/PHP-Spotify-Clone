<?php
include("./utils/getUrl.php");
include("./utils/dbConnection.php");
include("./auth/auth.php");

function redirect($url)
{
    echo "<script type='text/javascript'>document.location.href='{$url}';</script>";
    echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $url . '">';
}

$getAllSongsQuery = "SELECT songs.id, songs.title title,
                            songs.filePath audio, songs.imgPath img,
                            singers.name singerName, singers.id singerID
                    FROM songs 
                    LEFT JOIN singers on singers.id = songs.singerID
                    ORDER BY songs.dateAdded DESC";

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
    <link rel="stylesheet" href="./css/favourite.css">
    <link href='https://css.gg/home.css' rel='stylesheet'>
    <title>Spotify</title>
</head>

<body>
    <div class="login-modal">
        <div class="login-modal__logo">
            <i class="fab fa-spotify"></i>
            <h2>Not Spotify</h2>
        </div>
        <div class="login-modal__info">
            <p>You have to login to use this feature.</p>
            <a href="./auth/login.php" class="login">Login</a>
            <a href="./auth/signup.php" class="signup">Haven't create an account yet?</a>
            <div class="close">+</div>
        </div>
    </div>
    <div class="container">
        <div class="content">
            <!-- Sidebar -->
            <?php include("./components/sidebar.php"); ?>
            <!-- End sidebar -->

            <!-- Music UI -->
            <div class="musicContainer" id="home">
                <?php include("./pages/homeContent.php"); ?>
            </div>
            <div class="musicContainer hide" id="favourites">
                <?php if ($authenticated) : ?>
                    <?php include("./pages/favContent.php"); ?>
                <?php endif; ?>
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
    let authenticated = JSON.parse('<?php echo json_encode($authenticated); ?>');
</script>
<script src="./js/songTile.js"></script>
<script src="./js/playingQueue.js"></script>
<script src="./js/loginRequired.js"></script>
<script src="./js/main.js"></script>
<?php if ($authenticated) : ?>
    <script src="./js/favourite.js"></script>
<?php endif; ?>
<?php include("./utils/changePageJs.php"); ?>

</html>