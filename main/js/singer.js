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


const makeSongTitle = (index, song) => {
    console.log(index, song["id"]);
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
        <i class="far fa-heart"></i>
        <i class="fas fa-list-ul"></i>
    </div>
    `;

    const playButton = titleContainer.querySelector("h4");
    const heartIcon = titleContainer.querySelector("i.fa-heart");
    const queueIcon = titleContainer.querySelector("i.fa-list-ul");

    playButton.addEventListener('click', () => {
        playImmediate(song);
    })

    queueIcon.addEventListener('click', () => {
        insertToQueue(song);
    })

    return titleContainer;
};