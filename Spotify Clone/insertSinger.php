<?php
include('connection.php');


$errors = array('singername' => '', 'info' => '', 'img' => '');
$singername = $img = '';

function upFile($fileInfo)
{
    $fileName = $fileInfo['name'];
    $fileType = $fileInfo['type'];
    $fileTemp = $fileInfo['tmp_name'];
    $fileFolder = './images/upload/' . $fileName;

    if (move_uploaded_file($fileTemp, $fileFolder)) {
        echo ('Success');
    } else {
        echo ('Failed');
    }

    return $fileFolder;
}

if (isset($_POST['submit'])) {
    if (empty($_FILES['img']['name'])) {
        $errors['img'] = 'This field not be empty';
    }

    if (array_filter($errors)) {
        echo 'Form not valid';
    } else {
        $images = upFile($img);
    }

    $addReviewerQuery = "INSERT INTO singers(name, info, imgPath) 
    VALUES ('$singername', '$info', '$image')";

    echo $addReviewerQuery;
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Singer</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <form action="insertSinger.php" method="POST" enctype="multipart/form-data">
        <?php foreach ($errors as $error) : ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endforeach; ?>
        <h2>Singers</h2>

        <label>Name</label>
        <input type="text" name="singername" placeholder="Singer name"><br>

        <label>More</label>
        <textarea style=" margin: 0px; width: 360px; height: 164px; border: 2px solid #ccc; border-radius: 5px;" name="info" type="text" placeholder="Singer Info"></textarea><br>

        <label>File Images</label>
        <input type="file" name="img" accept="image/*> <br>

        <a href="editSinger.php" class="ca">BACK</a>

        <button type="submit" name="submit">Update</button>
    </form>
</body>

</html>