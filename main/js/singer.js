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
    if (!authenticated) {
        loginPopup();
    }
    else {
        const msg = (isFav) ? "xoa khoi yeu thich" : "them vao yeu thich";
        alert(msg + ' ' + song.title);

        const ajaxFile = (isFav) ? "delFromFav" : "addToFav";

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                if (this.responseText !== "") {
                    console.log(this.responseText);
                }
            }
        };
        xmlhttp.open("GET", `./utils/${ajaxFile}.php?songID=${song.id}`, true);
        xmlhttp.send();

        if (isFav) {
            const index = favSongIDs.indexOf(song.id);
            if (index > -1) {
                favSongIDs.splice(index, 1);
            }
            removeTileFromFav();
        }
        else {
            favSongIDs.push(song.id);
            makeSongTitleForFav(favSongIDs.length, song);
        }
        console.log(favSongIDs);
    }
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
        addToFav(song, favIcon.classList.contains('fas'));
        favIcon.className = (favIcon.classList.contains('fas')) ? "far fa-heart" : "fas fa-heart";
    });

    queueIcon.addEventListener('click', () => {
        insertToQueue(song);
    });

    return titleContainer;
};



const makeSongTitleForFav = (index, song) => {
    // console.log(index, song["id"]);
    const favContent = document.querySelector(".fav");
    const titleContainer = document.createElement("div");
    titleContainer.classList.add("song");
    titleContainer.setAttribute("data", song["id"]);

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
        <i class="fas fa-trash"></i>
        <i class="fas fa-list-ul"></i>
    </div>
    `;

    const playButton = titleContainer.querySelector("h4");
    const queueIcon = titleContainer.querySelector("i.fa-list-ul");

    playButton.addEventListener('click', () => {
        playImmediate(song);
    });

    queueIcon.addEventListener('click', () => {
        insertToQueue(song);
    });

    favContent.appendChild(titleContainer);
};


const removeTileFromFav = () => {
    const favContent = document.querySelector(".fav");
    favContent.innerHTML = `
        <h1>Favourites Songs</h1>
    `;
    favSongIDs.forEach((id, index) => {
        makeSongTitleForFav(index, songDetails[id]);
    })
}