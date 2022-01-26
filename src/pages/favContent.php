<?php
// Clean data from query result
function reformData($queryResult)
{
    return ($queryResult["songID"]);
}

$favSongsQuery = "SELECT favourites.songID FROM favourites
                  WHERE favourites.uid = $uid";

$result = mysqli_query($conn, $favSongsQuery);
$queryResult = mysqli_fetch_all($result, MYSQLI_ASSOC);

$favSongs = array_map("reformData", $queryResult);
?>
<?php include('./components/navbar.php'); ?>
<div class="fav">
    <h1>Favourites Songs</h1>
    <button>Play all</button>
    <div style="width: 100%;" class="tileContainer">
        <?php foreach ($favSongs as $index => $songID) : ?>
            <div class="song" data="<?php echo $formatSongs[$songID]['id']; ?>">
                <div class="info">
                    <h4><?php echo $index + 1; ?> </h4>
                    <img src="<?php echo $formatSongs[$songID]['img']; ?>">
                    <div class="detail">
                        <h4><?php echo $formatSongs[$songID]['title']; ?></h4>
                        <h5 data-singer="<?php echo $formatSongs[$songID]["singerID"]; ?>"><?php echo $formatSongs[$songID]['singerName']; ?></h5>
                    </div>
                </div>
                <div class="func">
                    <i class="fas fa-trash"></i>
                    <i class="fas fa-list-ul"></i>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<script>
    let favSongIDs = JSON.parse('<?php echo json_encode($favSongs); ?>');
</script>