// ----------------------------------- SONG TILTE ----------------------------------- //
const insertToQueue = (song) => {
    if (!playingQueue.includes(song)) {
        playingQueue.push(song);
        alert(`Songs ${song['title']} is added to queue!!`);
        resetPlayingQueue();
    }
    else {
        alert(`Songs ${song['title']} is already in playing queue!!`);
    }
};

const addToFav = (song, isFav) => {
    const msg = (isFav) ? "xoa vao yeu thich" : "them khoi yeu thich";
    alert(msg);
};


const makeSongTitle = (index, song) => {
    // console.log(index, song["id"]);
    const titleContainer = document.createElement("div");
    titleContainer.classList.add("song");
    titleContainer.setAttribute("data", song["id"]);

    let heartIcon = `<i class="far fa-heart"></i>`;

    if (authenticated) {
        if (favSongIDs.includes(song["id"])) heartIcon = `<i class="fas fa-heart" fav="1"></i>`;
    }

    titleContainer.innerHTML = `
    <div class="info">
        <h4>${index + 1}</h4>
        <img src="${song["img"]}">
        <div class="detail">
            <h4>${song["title"]}</h4>
            <h5 class="singerPage" data-singer="${song["singerID"]}">${song['singerName']}</h5>
        </div>
    </div>
    <div class="func">
        ${heartIcon}
        <i class="fas fa-list-ul"></i>
    </div>
    `;

    const playButton = titleContainer.querySelector("h4");
    const favIcon = titleContainer.querySelector("i.fa-heart");
    const queueIcon = titleContainer.querySelector("i.fa-list-ul");

    playButton.addEventListener('click', () => {
        playImmediate(song);
    });

    favIcon.addEventListener('click', () => {
        addToFav(song, favIcon.hasAttribute("fav"));
    });

    queueIcon.addEventListener('click', () => {
        insertToQueue(song);
    });

    return titleContainer;
};