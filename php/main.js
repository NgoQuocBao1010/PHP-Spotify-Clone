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

// Load song 
function loadSong(songID) {
    const song = songDetails[songID];
    console.log("Playing ", song['title']);

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
    isPlaying = true;
}

// Pause song
function pauseSong() {
    playBtn.querySelector('i.fas').classList.add('fa-play');
    playBtn.querySelector('i.fas').classList.remove('fa-pause');
    audio.pause();
    isPlaying = false;
}

// Update song progress
function updateProgess(e) {
    const { duration, currentTime } = e.srcElement;
    const progressPercent = (currentTime / duration) * 100;
    progress.style.width = `${progressPercent}%`;
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

function search(e) {
    console.log(e.target.value);
    window.history.pushState("", "", pageUrl + "/" + "search.php?search=" + e.target.value);
}

cards.forEach(card => {
    card.addEventListener('click', () => {
        const songID = card.getAttribute("data");
        loadSong(songID);
        playSong();
    })
})

songs.forEach(song => {
    song.addEventListener('click', () => {
        const songID = song.getAttribute("data");
        loadSong(songID);
        playSong();
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
progressContainer.addEventListener('click', setProgress);
volumeInfo.addEventListener('click', setVolume);
inputSearch.addEventListener('input', search);