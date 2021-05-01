const cards = document.querySelectorAll(".card");
const songs = document.querySelectorAll(".song");

// Song control buttons
const playBtn = document.querySelector('#play');
const prevBtn = document.querySelector('#prev');
const nextBtn = document.querySelector('#next');
const muteBtn = document.querySelector("#mute");

// Playing song detail
const audio = document.querySelector("#audio");
const coverImg = document.querySelector("#imgCover");
const title = document.querySelector("#title");
const singer = document.querySelector("#singer");
const progressContainer = document.querySelector(".progressContainer");
const progress = document.querySelector(".progress");
const volumeInfo = document.querySelector(".volumeInfo");
const volume = document.querySelector(".volume");

// Input
const inputSearch = document.querySelector(".search");

// checking variables
let isPlaying = false;
let currentVol = 1;
let playingQueue = [];
let songIndex = 0;

// Load song 
function loadSong(song) {
    // const song = songDetails[songID];
    // console.log("Playing ", song['title']);

    audio.src = song['audio'];
    coverImg.src = song['img'];
    title.innerText = song['title'];
    singer.innerText = song['singerName'];
}

// Play song
function playSong() {
    if (audio.src.includes("#")) return;

    playBtn.querySelector('i.fas').classList.remove('fa-play');
    playBtn.querySelector('i.fas').classList.add('fa-pause');
    audio.play();
    console.log(playingQueue);
    isPlaying = true;
}

// Play all songs in queue
function playQueue() {
    loadSong(playingQueue[songIndex]);
    playSong();
}

// Play 1 song immediately
function playImmediate(song) {
    playingQueue = [];
    playingQueue.push(song);
    playQueue();
}

// Pause song
function pauseSong() {
    playBtn.querySelector('i.fas').classList.add('fa-play');
    playBtn.querySelector('i.fas').classList.remove('fa-pause');
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
}

function prevSong() {
    songIndex--;

    if (songIndex < 0) {
        songIndex = playingQueue.length - 1;
    }

    loadSong(playingQueue[songIndex]);
    playSong();
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
    window.history.pushState("", "", pageUrl + "/" + "search.php?search=" + filterTexts);

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            if (this.responseText !== "") {
                // var data = JSON.parse(this.responseText);
                console.log(this.responseText);

                const songsContain = document.querySelector(".songsContain");
                songsContain.innerHTML = this.responseText;
                const songs = document.querySelectorAll(".song");
                songs.forEach(title => {
                    title.addEventListener('click', () => {
                        const songID = title.getAttribute("data");
                        const song = songDetails[songID];
                        playImmediate(song);
                    })
                })
            }
        }
    };
    xmlhttp.open("GET", "./utils/getSongs.php?filter=" + filterTexts, true);
    xmlhttp.send();
}


// Event listeners section
cards.forEach(card => {
    card.addEventListener('click', () => {
        const songID = card.getAttribute("data");
        const song = songDetails[songID];
        playImmediate(song);
    })
})

songs.forEach(title => {
    title.addEventListener('click', () => {
        const songID = title.getAttribute("data");
        const song = songDetails[songID];
        playImmediate(song);
    })
})

playBtn.addEventListener('click', () => {
    if (isPlaying) {
        pauseSong();
    }
    else {
        playSong();
    }
});
nextBtn.addEventListener('click', () => {
    nextSong();
});
prevBtn.addEventListener('click', () => {
    prevSong();
});

mute.addEventListener('click', () => {
    if (audio.volume != 0) {
        mute.classList.remove('fa-volume-up');
        mute.classList.add('fa-volume-mute');
        mute.style.color = 'red';
        audio.volume = 0;
        volume.style.width = '0%';
    }
    else {
        mute.classList.add('fa-volume-up');
        mute.classList.remove('fa-volume-mute');
        mute.style.color = 'lightgreen';
        audio.volume = currentVol;

        const volPercent = (currentVol / 1) * 100;

        volume.style.width = `${volPercent}% `;
    }
});

audio.addEventListener('timeupdate', updateProgess);
audio.addEventListener('ended', endSong);
progressContainer.addEventListener('click', setProgress);
volumeInfo.addEventListener('click', setVolume);
inputSearch.addEventListener('input', search);