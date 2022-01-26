<script type="text/javascript">
    let pageUrl = '<?php echo $app_url; ?>';
    const changePageBtns = document.querySelectorAll(".buttonContainer");

    // Switch between pages
    function showContent(page) {
        // Search bar appears when in search page
        const searchContainers = document.querySelectorAll(".searchContainer");
        searchContainers.forEach(container => {
            if (page === "search") {
                container.classList.remove("hide");
            } else {
                container.classList.add("hide");
            }
        })

        // Hide unsed and show used page
        document.querySelectorAll(".musicContainer").forEach(ui => {
            if (ui.id !== page) {
                ui.classList.add("hide");
            } else {
                ui.classList.remove("hide");
            }
        })
    }

    // alternate the url
    changePageBtns.forEach(button => {
        button.addEventListener('click', event => {
            const page = button.getAttribute("page-data");

            // Login required for favourites page
            if (!authenticated && page == "favourites") {
                loginPopup();
                return;
            }

            if (page === "home") {
                window.history.pushState("", "", pageUrl + "/");
            } else {
                window.history.pushState("", "", pageUrl + "/" + page + ".php");
            }

            showContent(page);
        })
    });
</script>