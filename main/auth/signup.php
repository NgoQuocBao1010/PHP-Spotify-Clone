<?php
include("../utils/dbConnection.php");

// Check for already login
if (isset($_SESSION['id'])) {
    header("Location: ../index.php");
}
$username = $password = $re_password = $name = "";
$errors = array('name' => '', 'username' => '', 'password' => '', 're_password' => '', "matchPass" => "", "existUser" => "");
if (isset($_POST['submit'])) {
    function cleanData($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $username = cleanData($_POST['username']);
    $password = cleanData($_POST['password']);

    $re_password = cleanData($_POST['re_password']);
    $name = cleanData($_POST['name']);


    if (empty($username)) {
        $errors['username'] = "Username cant be empty!!!";
    }
    if (empty($name)) {
        $errors['name'] = "Name cant be empty!!!";
    }
    if (empty($password)) {
        $errors['password'] = "password cant be empty!!!";
    }
    if (empty($re_password)) {
        $errors['re_password'] = "re password cant be empty!!!";
    }
    if ($password !== $re_password) {
        $errors['matchPass'] = "The confirmation password does not match";
    }

    $sql = "SELECT * FROM users WHERE username = '$username' ";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $errors['existUser'] = "User is already exist";
    }

    if (array_filter($errors)) {
        echo "Have errors";
    } else {
        $password = md5($password);
        $sql2 = "INSERT INTO users(username, password, name, groupID) VALUE('$username', '$password', '$name', 2)";
        $result2 = mysqli_query($conn, $sql2);
        if ($result2) header("Location: login.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIGN UP</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <form action="signup.php" method="post">
        <h2>SIGN UP</h2>
        <?php foreach ($errors as $error) : ?>
            <p><?php echo $error; ?></p>
        <?php endforeach; ?>

        <label>Name</label>
        <input type="text" name="name" placeholder="Name" value="<?php echo $name; ?>"><br>

        <label>Username</label>
        <input type="text" name="username" placeholder="Username" value="<?php echo $username; ?>"><br>

        <label>Password</label>
        <input type="password" name="password" placeholder="Password" value="<?php echo $password; ?>"><br>

        <label>Confirm Password</label>
        <input type="password" name="re_password" placeholder="Confirm Password"><br>

        <button type="submit" name="submit">Sign Up</button>
        <a href="login.php" class="ca">Already have an account?</a>
    </form>
</body>

</html>