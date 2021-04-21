const buttons = document.querySelectorAll(".buttonContainer");
const cards = document.querySelectorAll(".card");
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

// Song Detail
const songDetails = {
    'ctcht': {
        'title': 'Chúng ta của hiện tại',
        'singer': 'Sơn Tùng MTP',
    },
    'tscnl': {
        'title': 'Tâm sự cùng người lạ',
        'singer': 'Tiên Cookie',
    },
    'bp': {
        'title': 'Bạc Phận (Masew Remix)',
        'singer': 'Jack, K-ICM ft Masew',
    },
    '3107': {
        'title': '3107',
        'singer': 'Dương ft Nâu',
    },
}

// checking variables
let isPlaying = false;
let currentVol = 1;

// Load song 
function loadSong(songCode) {
    const songUrl = `./music/${songCode}.mp3`;
    const songImgUrl = `./images/${songCode}.png`;

    audio.src = songUrl;
    coverImg.src = songImgUrl;
    title.innerText = songDetails[songCode]['title'];
    singer.innerText = songDetails[songCode]['singer'];
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


// Click Listener
buttons.forEach(button => {
    button.addEventListener('click', event => {
        //handle click
        if (button.classList.contains('active')) {
            button.classList.remove('active');
        }
        else {
            button.classList.add('active');
        }
    })
})

cards.forEach(card => {
    card.addEventListener('click', () => {
        const songCode = card.getAttribute("data");
        loadSong(songCode);
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