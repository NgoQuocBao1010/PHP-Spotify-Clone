<?php 
    include("./pages/dbConnection.php");

    $getSingers = "SELECT * from Singers";
    $result = mysqli_query($conn, $getSingers);
    $singers = mysqli_fetch_all($result, MYSQLI_ASSOC);

    $errors = array('title' => '', 'mp3' => '', 'img' => '');
    $title = $mp3 = $img = $singerID = '';

    function saveFile($fileInfo) {
      print_r($fileInfo);
    }


    if (isset($_POST['save'])) {
        if (empty($_POST['title'])) {
          $errors['title'] = "This field cannot be empty";
        }
        else {
          $title = $_POST['title'];
        }

        if (empty($_FILES["mp3"]["name"])) {
          $errors['mp3'] = "This field cannot be empty";
        }
        else {
          if ($_FILES["mp3"]["type"] === "audio/mpeg") {
            $mp3 = $_FILES['mp3'];
          }
          else {
            $errors['mp3'] = "Wrong file format. Expect an .mp3 file. Please check your file again.";
          }
        }

        if (empty($_FILES["img"]["name"])) {
          $errors['img'] = "This field cannot be empty";
        }
        else {
          if (strpos($_FILES["img"]["type"], "image") !== false ) {
            $img = $_FILES['img'];
          }
          else {
            $errors['img'] = "Wrong file format. Expect an image file. Please check your file again.";
          }
        }
        // $filename = $_FILES['myfile']['name'];

        // // save location
        // $destination = "images/" . $filename;

        // // file extension
        // $extension = pathinfo($filename, PATHINFO_EXTENSION);
        
        // // tmp location that file is temporaly saved
        // $file = $_FILES['myfile']['tmp_name'];

        // // file size
        // $size = $_FILES['myfile']['size'];

        // if (!in_array($extension, ['png', 'mp3'])) {
        //     echo "You file extension must be .png or .mp3";
        // } elseif ($_FILES['myfile']['size'] > 10000000) { // file shouldn't be larger than 1Megabyte
        //     echo "File too large!";
        // } else {
        //     if (move_uploaded_file($file, $destination)) {
        //         echo "Successfully uploaded";
        //     }
        //     else {
        //         echo "Upload fail";
        //     }
        // }
    }

    if (array_filter($errors)) {
      echo "Form not valid";
    }
    else {
      saveFile($mp3);
      saveFile($img);
    }
?>

<html lang="en">
  <head>
    <link rel="stylesheet" href="style.css">
    <title>Files Upload and Download</title>
  </head>
  <style>
        form {
            width: 30%;
            margin: 100px auto;
            padding: 30px;
            border: 1px solid #555;
            }
        input {
            width: 100%;
            border: 1px solid #f1e1e1;
            display: block;
            padding: 5px 10px;
        }
        button {
            border: none;
            padding: 10px;
            border-radius: 5px;
            font-family: san-serif;
        }
        table {
            width: 60%;
            border-collapse: collapse;
            margin: 100px auto;
        }
        th,
        td {
            height: 50px;
            vertical-align: center;
            border: 1px solid black;
        }
        .error {
          color: red;
          font-size: 10px;
        }
  </style>
  <body>
    <div class="container">
      <div class="row">
        <form action="uploadSongs.php" method="post" enctype="multipart/form-data" >
          <h3>Title</h3>
          <input type="text" name="title" value="<?php echo $title; ?>">
          <p class="error"><?php echo $errors['title']; ?></p>
          <h3>Singer</h3>
          <select style="width: 40%; height: 30px;" name="singer" value="<?php echo $singerID; ?>">
              <?php foreach ($singers as $singer): ?>
                  <option value='<?php echo $singer['id'] ?>'><?php echo $singer['name']; ?></option>
              <?php endforeach; ?>
          </select>
          <h3>MP3 File</h3>
          <input type="file" name="mp3">
          <p class="error"><?php echo $errors['mp3']; ?></p>
          <h3>Cover Img</h3>
          <input type="file" name="img">
          <p class="error"><?php echo $errors['img']; ?></p> <br>
          <button type="submit" name="save" >Save</button>
        </form>
      </div>
    </div>
  </body>
</html>