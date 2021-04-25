<?php
    include("./components/getUrl.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
        crossorigin="anonymous" />
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
            <div class="musicContainer">
                <?php include("./pages/searchContent.php"); ?>
            </div>
            <!-- End Music UI -->
        </div>

        <!-- Music Player -->
        <?php include("./components/musicPlayer.php"); ?>
    </div>
</body>
<script src="main.js"></script>
<?php include("./components/changePageJs.php"); ?>

</html>