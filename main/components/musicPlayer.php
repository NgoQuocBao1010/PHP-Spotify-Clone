<div class="musicPlayerContainer">
    <div class="musicInfo">
        <img id="imgCover" src="./images/logo.jpg" alt="">
        <div class="musicDetail">
            <h4 id="title"></h4>
            <h5 id="singerName"></h5>
        </div>
        <!-- <i class="far fa-heart"></i> -->
    </div>
    <div class="musicPlayer">
        <div class="navigation">
            <button id="prev" class="action-btn">
                <i class="fas fa-backward"></i>
            </button>
            <button id="play" class="action-btn action-btn-big">
                <i class="fas fa-play"></i>
            </button>
            <button id="next" class="action-btn">
                <i class="fas fa-forward"></i>
            </button>
        </div>
        <div class="progressContainer">
            <div class="progress"></div>
        </div>
        <audio id="audio" src="#"></audio>
    </div>
    <div class="funcContainer">
        <img id="playtist" src="./images/icons/queue.png" alt="" />
        <i class="fas fa-volume-up" id="mute"></i>
        <div class="volumeInfo">
            <div class="volume"></div>
        </div>
    </div>
    <div class="queue">
        <div class="queue-title">
            <h3>Playing Songs</h3>
            <i class="fas fa-chevron-up"></i>
        </div>
        <ul class="playing-songs">
        </ul>
    </div>
</div>