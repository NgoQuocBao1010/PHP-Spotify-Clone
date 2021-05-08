<?php 
    include('dbConnection.php');

    $getUserQuery = "SELECT * FROM Users";
    $result = mysqli_query($conn, $getUserQuery);
    $users = mysqli_fetch_all($result, MYSQLI_ASSOC);

    // print_r($users);
    session_start();

    $username = 'Guest';
    if (isset($_SESSION['login'])) {
        $username = $_SESSION['username'];
    }

    if (isset($_SESSION['role'])) {
        $role = $_SESSION['role'];
        echo $role;
    }

    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['username']);
        header("location: index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Page</title>
</head>
<body>
    <h1>Hello, <?php echo $username ?></h1>

    <?php if (isset($_SESSION['login'])): ?>
    <a href="index.php?logout='1'">Logout</a>
    <?php else: ?>
        <h1>You should login MotherFucker</h1>
        <a href="login.php">Login</a>
    <?php endif; ?>
</body>
</html>