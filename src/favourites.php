<?php include("./index.php") ?>
<script>
    if (!authenticated) {
        loginPopup();
        window.history.pushState("", "", pageUrl + "/");
    } else
        showContent("favourites");
</script>