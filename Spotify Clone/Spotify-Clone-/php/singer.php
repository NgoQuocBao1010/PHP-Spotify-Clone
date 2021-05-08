<?php
include("./index.php");
?>

<script>
    showContent("singer");
</script>
<script>
    let singerSongs = JSON.parse('<?php echo json_encode($songs); ?>');
    const pulseBtn = document.querySelector(".pulse");
    pulseBtn.addEventListener("click", () => {
        // console.log("Playing all song from " + data["name"]);
        playingQueue = singerSongs;
        songIndex = 0;
        playQueue();
    })
</script>