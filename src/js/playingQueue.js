// ----------------------------------- PLAYING QUEUE ----------------------------------- //

// Add new song to queue
const addPlayingSong = (song, index) => {
    const newSong = document.createElement("li");

    if (index === songIndex) {
        newSong.classList.add("playing");
    }
    newSong.setAttribute("song-index", index);

    newSong.innerHTML = `
        <div class="song-info">${index + 1}. ${song.title}</div>
        <div class="beat-container">
            <div class="stroke"></div>
            <div class="stroke"></div>
            <div class="stroke"></div>
        </div>
    `;

    // Click event for that element (check if that song is already playing)
    newSong.addEventListener("click", () => {
        const nowPlayingSong = document.querySelector("li.playing");

        if (newSong !== nowPlayingSong) {
            nowPlayingSong.classList.remove("playing");
            newSong.classList.add("playing");
            songIndex = index;
            loadSong(playingQueue[songIndex]);
            playSong();
        }
    });

    return newSong;
};

// Update and refresh the playing queue base on song event
const resetPlayingQueue = () => {
    const songsContainer = document.querySelector(".queue .playing-songs");
    songsContainer.innerHTML = "";

    if (playingQueue.length !== 0) {
        playingQueue.forEach((song, index) => {
            const newSong = addPlayingSong(song, index);
            songsContainer.appendChild(newSong);
        });
    }
};

// Show playing queue button's click event
const playingQueueIcon = document.getElementById("playtist");
playingQueueIcon.addEventListener("click", () => {
    const modal = document.querySelector(".queue");
    modal.classList.toggle("queue-active");

    // resetPlayingQueue();
});

// Hide playing queue symbols
const collaspIcon = document.querySelector(".fa-chevron-up");
collaspIcon.addEventListener("click", () => {
    const modal = document.querySelector(".queue");
    modal.classList.remove("queue-active");
});
