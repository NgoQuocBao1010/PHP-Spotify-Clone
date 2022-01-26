const cards = document.querySelectorAll(".card");
const songsTile = document.querySelectorAll(".song");

// Song control buttons
const playBtn = document.querySelector("#play");
const prevBtn = document.querySelector("#prev");
const nextBtn = document.querySelector("#next");
const muteBtn = document.querySelector("#mute");

// Playing song detail
const audio = document.querySelector("#audio");
const coverImg = document.querySelector("#imgCover");
const title = document.querySelector("#title");
const singerName = document.querySelector("#singerName");
const progressContainer = document.querySelector(".progressContainer");
const progress = document.querySelector(".progress");
const volumeInfo = document.querySelector(".volumeInfo");
const volume = document.querySelector(".volume");

// Input
const inputSearchs = document.querySelectorAll(".search");

// checking variables
let isPlaying = false;
let currentVol = 1;
let playingQueue = [];
let songIndex = 0;

// Profile Logo
const profilePics = document.querySelectorAll(".logo");
profilePics.forEach((pic) => {
    pic.addEventListener("click", () => {
        const links = document.querySelectorAll(".logo-links");

        links.forEach((link) => {
            link.classList.toggle("logo-active");
        });
    });
});

// Update function to all the singer's links
function goToSingerPage() {
    const singerLinks = document.querySelectorAll(".singerPage");
    singerLinks.forEach((link) => {
        link.addEventListener("click", () => {
            const singerID = link.getAttribute("data-singer");

            // update url
            window.history.pushState(
                "",
                "",
                pageUrl + "/" + "singer.php" + "?singerID=" + singerID
            );

            // Show singer page
            showContent("singer");

            // Ajax connection to get singer's info and songs
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    if (this.responseText !== "") {
                        var data = JSON.parse(this.responseText);

                        const singerUI = document.getElementById("singer");

                        // Update singer's personal info
                        const sImg = singerUI.querySelector(".cover img");
                        sImg.src = data["image"];
                        const sName = singerUI.querySelector(".coverDetail h1");
                        sName.innerText = data["name"];
                        const sDescription =
                            singerUI.querySelector(".description p");
                        sDescription.innerText = data["info"];
                        const sDesImg =
                            singerUI.querySelector(".description img");
                        sDesImg.src = data["image"];

                        // Make all the song cards (song title)
                        const allSingerSongs =
                            singerUI.querySelector(".products");
                        allSingerSongs.innerHTML = "";
                        data["songs"].forEach((song, index) => {
                            const newTitle = makeSongTitle(index, song);
                            allSingerSongs.appendChild(newTitle);
                        });

                        // Replace new pulse btn
                        const pulseBtn = document.querySelector(".pulse");
                        const newPulseBtn = pulseBtn.cloneNode(true);
                        pulseBtn.parentNode.replaceChild(newPulseBtn, pulseBtn);
                        newPulseBtn.addEventListener("click", () => {
                            playingQueue = data["songs"];
                            songIndex = 0;
                            playQueue();
                        });
                    }
                }
            };
            xmlhttp.open(
                "GET",
                "./utils/getSingerInfo.php?singerID=" + singerID,
                true
            );
            xmlhttp.send();
        });
    });
}

// Load song
function loadSong(song) {
    audio.src = song["audio"];
    coverImg.src = song["img"];
    title.innerText = song["title"];
    singerName.innerText = song["singerName"];
}

// Play song
function playSong() {
    if (audio.src.includes("#")) return;

    playBtn.querySelector("i.fas").classList.remove("fa-play");
    playBtn.querySelector("i.fas").classList.add("fa-pause");
    audio.play();
    isPlaying = true;
}

// Play all songs in queue
function playQueue() {
    loadSong(playingQueue[songIndex]);
    playSong();
    resetPlayingQueue();
}

// Play 1 song immediately
function playImmediate(song) {
    songIndex = 0;
    playingQueue = [];
    playingQueue.push(song);
    playQueue();
    resetPlayingQueue();
}

// Pause song
function pauseSong() {
    playBtn.querySelector("i.fas").classList.add("fa-play");
    playBtn.querySelector("i.fas").classList.remove("fa-pause");
    audio.pause();
    isPlaying = false;
}

function nextSong() {
    songIndex++;

    if (songIndex > playingQueue.length - 1) {
        songIndex = 0;
    }

    loadSong(playingQueue[songIndex]);
    playSong();
    resetPlayingQueue();
}

function prevSong() {
    songIndex--;

    if (songIndex < 0) {
        songIndex = playingQueue.length - 1;
    }

    loadSong(playingQueue[songIndex]);
    playSong();
    resetPlayingQueue();
}

// Update song progress
function updateProgess(e) {
    const { duration, currentTime } = e.srcElement;
    const progressPercent = (currentTime / duration) * 100;
    progress.style.width = `${progressPercent}%`;
}

// Endsong
function endSong() {
    nextSong();
}

// Set song progess on click
function setProgress(e) {
    // Get the width of the cliked element
    const width = this.clientWidth;

    // Get the place where the click occur according to the element itself
    const clickX = e.offsetX;

    const duration = audio.duration;
    audio.currentTime = (clickX / width) * duration;
}

// set volume on click
function setVolume(e) {
    const width = this.clientWidth;
    const clickX = e.offsetX;
    volumePercent = (clickX / width) * 100;

    currentVol = (clickX / width) * 1;
    audio.volume = currentVol;
    volume.style.width = `${volumePercent}%`;
}

// Search songs in realtime
function search(e) {
    let filterTexts = e.target.value;

    window.history.pushState(
        "",
        "",
        pageUrl + "/" + "search.php?search=" + filterTexts
    );

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            if (this.responseText !== "") {
                var songs = JSON.parse(this.responseText);
                const songsContain = document.querySelector(".songsContain");
                songsContain.innerHTML = "";

                songs.forEach((song, index) => {
                    const newTitle = makeSongTitle(index, song);
                    songsContain.appendChild(newTitle);
                });
                goToSingerPage();
            }
        }
    };
    xmlhttp.open("GET", "./utils/getSongs.php?filter=" + filterTexts, true);
    xmlhttp.send();
}

// Event listeners section
cards.forEach((card) => {
    card.addEventListener("click", () => {
        const songID = card.getAttribute("data");
        const song = songDetails[songID];
        playImmediate(song);
    });
});

songsTile.forEach((tile) => {
    let info = tile.querySelector(".info h4");
    const queueIcon = tile.querySelector("i.fa-list-ul");
    const favIcon = tile.querySelector("i.fa-heart");
    const trashIcon = tile.querySelector("i.fa-trash");
    const songID = tile.getAttribute("data");
    const song = songDetails[songID];

    info.addEventListener("click", () => {
        playImmediate(song);
    });

    queueIcon.addEventListener("click", () => {
        insertToQueue(song);
    });

    if (favIcon) {
        favIcon.addEventListener("click", () => {
            addToFav(song, favIcon.classList.contains("fas"));
            if (authenticated)
                favIcon.className = favIcon.classList.contains("fas")
                    ? "far fa-heart"
                    : "fas fa-heart";
        });
    }

    if (trashIcon) {
        trashIcon.addEventListener("click", () => {
            const searchSongTiles = document.querySelectorAll("#search .song");
            searchSongTiles.forEach((tile) => {
                const songID = tile.getAttribute("data");
                if (songID == song.id) {
                    const heartIcon = tile.querySelector(".func .fa-heart");
                    heartIcon.className = "far fa-heart";
                }
            });
            addToFav(song, true);
        });
    }
});

playBtn.addEventListener("click", () => {
    if (isPlaying) {
        pauseSong();
    } else {
        playSong();
    }
});

nextBtn.addEventListener("click", () => {
    nextSong();
});

prevBtn.addEventListener("click", () => {
    prevSong();
});

mute.addEventListener("click", () => {
    if (audio.volume != 0) {
        mute.classList.remove("fa-volume-up");
        mute.classList.add("fa-volume-mute");
        mute.style.color = "red";
        audio.volume = 0;
        volume.style.width = "0%";
    } else {
        mute.classList.add("fa-volume-up");
        mute.classList.remove("fa-volume-mute");
        mute.style.color = "lightgreen";
        audio.volume = currentVol;

        const volPercent = (currentVol / 1) * 100;

        volume.style.width = `${volPercent}% `;
    }
});

audio.addEventListener("timeupdate", updateProgess);
audio.addEventListener("ended", endSong);
progressContainer.addEventListener("click", setProgress);
volumeInfo.addEventListener("click", setVolume);
inputSearchs.forEach((inputSearch) => {
    inputSearch.addEventListener("input", search);
});

goToSingerPage();
