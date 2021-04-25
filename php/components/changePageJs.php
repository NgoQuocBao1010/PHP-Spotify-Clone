<script type="text/javascript">
    let pageUrl = '<?php echo $app_url; ?>';
    const changePageBtns = document.querySelectorAll(".buttonContainer");
    const musicUI = document.querySelector(".musicContainer");

    changePageBtns.forEach(button => {
        button.addEventListener('click', event => {
            const page = button.getAttribute("page-data");

            if (page === "home") {
                window.history.pushState("", "", pageUrl + "/" + "index" + ".php");
            }
            else {
                window.history.pushState("", "", pageUrl + "/" + page + ".php");
            }

            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var data = JSON.parse(this.responseText);
                    console.log(data);
                    musicUI.innerHTML =  data['data'];

                    if (page != "search") {
                        cardsClick();
                    }
                }
            };
            xmlhttp.open("GET", "getPage.php?page=" + page, true);
            xmlhttp.send();
        })
    });

    function cardsClick() {
        const cards = document.querySelectorAll(".card");
        cards.forEach(card => {
            card.addEventListener('click', () => {
                const songCode = card.getAttribute("data");
                console.log(songCode);
                loadSong(songCode);
                playSong();
            })
        })
    }
</script>