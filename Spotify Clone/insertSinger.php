<?php
include('connection.php');
$name = $infoSinger = "";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql2 = "SELECT * FROM singers WHERE id= '$id' ";
    $res2 = mysqli_query($conn, $sql2);
    $data = mysqli_fetch_array($res2);
    $name = $data["name"];
    $infoSinger = $data["info"];
}


$errors = array('singername' => '', 'info' => '', 'img' => '');
$singername = $img = $info = '';



// if (isset($_POST['submit'])) {
//     if (empty($_POST['singername'])) {
//         $errors['singername'] = "Please enter some name of singer";
//     }
//     if (empty($_POST['info'])) {
//         $errors['info'] = "Please enter some informations";
//     }
// }



// insert singer into database
function saveFile($fileInfo)
{
    $filename = $fileInfo['name'];
    $type = $fileInfo['type'];
    $folder = (strpos($type, "image") !== false) ? 'images' : '';

    $tmpPath = $fileInfo['tmp_name'];
    $destination = $folder . '/upload/' . $filename;

    if (move_uploaded_file($tmpPath, $destination)) {
        echo "Successfully uploaded";
    } else {
        echo "Upload fail";
    }

    return $destination;
}
if (isset($_POST['submit'])) {
    if (empty($_FILES["img"]["name"])) {
        $errors['img'] = "Image field cannot be empty";
    } else {
        if (strpos($_FILES["img"]["type"], "image") !== false) {
            $img = $_FILES['img'];
        } else {
            $errors['img'] = "Wrong file format. Expect an image file. Please check your file again.";
        }
    }

    if (empty($_POST['singername'])) {
        $errors['singername'] = "Singer's name can not be empty";
    } else {
        $singername = $_POST['singername'];
    }

    if (empty($_POST['info'])) {
        $errors['info'] = "Info can not be empty";
    } else {
        $info = $_POST['info'];
    }


    if (array_filter($errors)) {
        echo 'Form not valid';
    } else {
        $images = saveFile($img);

        if (isset($_GET['id'])) {
            echo "hghgjj";
            $updateSinger = "UPDATE singers SET name = '$singername', info = '$info' WHERE id =$id";
            $res3 = mysqli_query($conn, $updateSinger);
            header("Location: adminDashboard.php");
        } else {
            $insertSinger = "INSERT INTO singers(name, info, image)
            VALUES ('$singername', '$info', '$images')";
            // echo $addReviewerQuery;
            if (!mysqli_query($conn, $insertSinger)) {
                echo  "Error: " . "<br>" . mysqli_error($conn);
            } else {
                // header("Location: adminDashboard.php");
            }
        }
    }
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
    <form method="POST" enctype="multipart/form-data">
        <?php foreach ($errors as $error) : ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endforeach; ?>
        <h2>Singers</h2>

        <label>Name</label>
        <input type="text" name="singername" placeholder="Singer name" value="<?php echo $name; ?>"><br>
        <label>More</label>
        <textarea style=" margin: 0px; width: 360px; height: 164px; border: 2px solid #ccc; border-radius: 5px;" name="info" type="text" placeholder="Singer Info"><?php echo $infoSinger; ?></textarea><br>

        <label>File Images</label>
        <input type="file" name="img" accept="image/*"> <br>

        <a href="editSinger.php" class="ca">BACK</a>

        <button type="submit" name="submit">Update</button>
    </form>
</body>

</html>