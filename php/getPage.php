<?php
    if(isset($_GET['page'])) {
        $page = $_GET['page'];

        if ($page === "search") {
            echo json_encode(array(
                'page' => $page,
                'data'=>file_get_contents('./pages/searchContent.php'),
            ));
        }
        else {
            echo json_encode(array(
                'page' => $page,
                'data'=>file_get_contents('./pages/homeContent.php'),
            ));
        }
        
    }
?>