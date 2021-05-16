<script type="text/javascript">
    let pageUrl = '<?php echo $app_url; ?>';
    const changePageBtns = document.querySelectorAll(".buttonContainer");



    function showContent(page) {
        const searchContainers = document.querySelectorAll(".searchContainer");

        searchContainers.forEach(container => {
            if (page === "search") {
                container.classList.remove("hide");
            } else {
                container.classList.add("hide");
            }
        })

        document.querySelectorAll(".musicContainer").forEach(ui => {
            // ui.style.display = (ui.id !== page) ? 'none' : '';
            if (ui.id !== page) {
                ui.classList.add("hide");
            } else {
                ui.classList.remove("hide");
            }
        })
    }

    changePageBtns.forEach(button => {
        button.addEventListener('click', event => {
            const page = button.getAttribute("page-data");

            if (page === "home") {
                window.history.pushState("", "", pageUrl + "/" + "index.php");
            } else {
                window.history.pushState("", "", pageUrl + "/" + page + ".php");
            }

            showContent(page);
        })
    });
</script>