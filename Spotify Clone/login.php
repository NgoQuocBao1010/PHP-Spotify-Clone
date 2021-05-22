<?php
include("connection.php");
session_start();
if (isset($_SESSION['id'])) {
    header("Location: home.php");
}
$username = $password = "";
$errors = array('username' => '', 'password' => '');

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

    if (empty($username)) {
        $errors['username'] = "Username cant be empty!!!";
    }

    if (empty($password)) {
        $errors['password'] = "Password cant be empty!!!";
    } else {
        $password = md5($password);
        $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            if ($row['username'] === $username && $row['password'] === $password) {
                $_SESSION['username'] = $row['username'];
                $_SESSION['name'] = $row['name'];
                $_SESSION['id'] = $row['id'];
                $_SESSION['admin'] = ($row['groupID'] == 1) ? true : false;

                header("Location: home.php");
                exit();
                echo "<h1 style='color: white;'>Thanh cong</h1>";
            } else {
                $errors['password'] = "Incorrect username or password!";
            }
        } else {
            $errors['username'] = "Incorrect username or password!";
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
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <form action="login.php" method="post">
        <h2>LOGIN</h2>
        <?php foreach ($errors as $error) : ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endforeach; ?>
        <label>Username</label>
        <input type="text" name="username" placeholder="Username" value="<?php echo $username; ?>"><br>

        <label>Password</label>
        <input type="password" name="password" placeholder="Password"><br>

        <button type="submit" name="submit">Login</button>
        <a href="signup.php" class="ca">Create an account</a>
    </form>
</body>

</html>