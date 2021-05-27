<?php
include("connection.php");
$getSingers = "SELECT * from Singers";
$result = mysqli_query($conn, $getSingers);
$singers = mysqli_fetch_all($result, MYSQLI_ASSOC);


session_start();
if ($_SESSION['id']) {
    $id = $_SESSION['id'];
}

$titleUpdate = "";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql2 = "SELECT * FROM songs WHERE id= '$id' ";
    $res2 = mysqli_query($conn, $sql2);
    $data = mysqli_fetch_array($res2);
    $titleUpdate = $data["title"];
}

$errors = array('title' => '', 'mp3' => '', 'img' => '');
$title = $mp3 = $img = $singerID = '';

function saveFile($fileInfo)
{
    $filename = $fileInfo['name'];
    $type = $fileInfo['type'];
    $folder = (strpos($type, "image") !== false) ? 'images' : 'music';

    $tmpPath = $fileInfo['tmp_name'];
    $destination = $folder . '/' . $filename;

    if (move_uploaded_file($tmpPath, $destination)) {
        echo "Successfully uploaded";
    } else {
        echo "Upload fail";
    }

    return $destination;
}

if (isset($_POST['submit'])) {
    if (empty($_POST['title'])) {
        $errors['title'] = "Title cannot be empty";
    } else {
        $title = $_POST['title'];
    }

    $singerID = $_POST['singer'];

    if (empty($_FILES["mp3"]["name"])) {
        $errors['mp3'] = "Music File cannot be empty";
    } else {
        if ($_FILES["mp3"]["type"] === "audio/mpeg") {
            $mp3 = $_FILES['mp3'];
        } else {
            $errors['mp3'] = "Wrong file format. Expect an .mp3 file. Please check your file again.";
        }
    }

    if (empty($_FILES["img"]["name"])) {
        $errors['img'] = "Image file cannot be empty";
    } else {
        if (strpos($_FILES["img"]["type"], "image") !== false) {
            $img = $_FILES['img'];
        } else {
            $errors['img'] = "Wrong file format. Expect an image file. Please check your file again.";
        }
    }

    if (array_filter($errors)) {
        echo 'Form not valid';
    } else {
        $mp3Path = saveFile($mp3);
        $imgPath = saveFile($img);

        if (isset($_GET['id'])) {
            $updateSong = "UPDATE songs SET title = '$title', filePath = '$mp3Path', imgPath = '$imgPath', singerID = '$singerID' WHERE id =$id";
            $res3 = mysqli_query($conn, $updateSong);
            header("Location: editSong.php");
        } else {
            $insertSong = "INSERT INTO Songs(title, filePath, imgPath, singerID) 
                             VALUES ('$title', '$mp3Path', '$imgPath', $singerID)";
            if (!mysqli_query($conn, $insertSong)) {
                echo  "Error: " . "<br>" . mysqli_error($conn);
            } else {
                header("Location: editSong.php");
            }
        }
    }
}


// if (isset($_POST['delete'])) {
//     $songSelect = $_POST['songSelect'];
//     $sql = "DELETE FROM songs WHERE `id` = $songSelect ";
//     $res = mysqli_query($conn, $sql);
//     if ($res) header("Location: editSong.php");
// }


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Song</title>
    <link rel="stylesheet" href="song.css">
</head>

<body>
    <div class="add-info">
        <h3 class="notice">UPLOAD SONGS</h3>
        <form class="form-insert" method="POST" enctype="multipart/form-data">
            <?php foreach ($errors as $error) : ?>
                <p class="error"><?php echo $error; ?></p>
            <?php endforeach; ?>
            <label>Title</label>
            <input type="text" name="title" placeholder="Title" value="<?php echo $titleUpdate; ?>">
            <label>Singer</label>
            <select name="singer">
                <?php foreach ($singers as $singer) : ?>
                    <option value='<?php echo $singer['id'] ?>'><?php echo $singer['name']; ?></option>
                <?php endforeach; ?>
            </select>
            <label>MP3 File</label>
            <input type="file" name="mp3" accept="audio/*">
            <label>Images</label>
            <input type="file" name="img" accept="image/*">
            <button type="submit" name="submit">SUBMIT</button>
        </form>
    </div>

</body>

</html>