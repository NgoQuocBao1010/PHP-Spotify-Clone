<?php
session_start();
$groupID = $username = $name = '';
if (isset($_SESSION['username'])) {
    $groupID = $_SESSION['groupID'];
    $username = $_SESSION['username'];
    $name = $_SESSION['name'];
} else {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOME</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>Hello, <?php echo $name; ?></h1>
    <a href="./change-password.php">Change Password</a>
    <?php if ($groupID === '1') : ?>
        <a href="dashboard.php">Admin Dashborad</a>
    <?php endif; ?>
    <a href="logout.php">Logout</a>
</body>

</html>