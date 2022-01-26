<?php
include("./dbConnection.php");
include("../auth/auth.php");

if (isset($_GET['songID'])) {
    $songID = $_GET['songID'];

    $addToFavQuery = "DELETE FROM favourites
                    WHERE favourites.uid=$uid and songID=$songID;";

    if (mysqli_query($conn, $addToFavQuery)) {
        echo json_encode("Delele " . $songID);
    } else {
        echo json_encode("Error " . mysqli_error($conn));
    }
}
