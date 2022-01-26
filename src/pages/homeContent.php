<?php include('./components/navbar.php'); ?>
<section>
    <h1 class="sectionTitle">Recommend Songs</h1>
    <div class="cards">
        <?php foreach ($randomKeys as $key) : ?>
            <div class="card" data="<?php echo $songs[$key]["id"]; ?>">
                <div class="imgContainer">
                    <img src="<?php echo $songs[$key]["img"]; ?>" alt="">
                </div>
                <div class="cardInfo">
                    <h3><?php echo $songs[$key]["title"]; ?></h3>
                    <h5><?php echo $songs[$key]["singerName"]; ?></h5>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>
<section>
    <h1 class="sectionTitle">New Songs</h1>
    <div class="cards">
        <div class="card" data="<?php echo $songs[0]["id"]; ?>">
            <div class="imgContainer">
                <img src="<?php echo $songs[0]["img"]; ?>" alt="">
            </div>
            <div class="cardInfo">
                <h3><?php echo $songs[0]["title"]; ?></h3>
                <h5><?php echo $songs[0]["singerName"]; ?></h5>
            </div>
        </div>
        <div class="card" data="<?php echo $songs[1]["id"]; ?>">
            <div class="imgContainer">
                <img src="<?php echo $songs[1]["img"]; ?>" alt="">
            </div>
            <div class="cardInfo">
                <h3><?php echo $songs[1]["title"]; ?></h3>
                <h5><?php echo $songs[1]["singerName"]; ?></h5>
            </div>
        </div>
    </div>
</section>