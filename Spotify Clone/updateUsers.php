<?php
include("connection.php");

$id = $_GET['id'];

$sql = "SELECT * FROM users where id = '$id'";
$result = mysqli_query($conn,$sql);
$data = mysqli_fetch_array($result);

if(isset($_POST['update'])){

    $id = $_GET['id'];

    $name = $_POST['name'];
    $username = $_POST['username'];

    $updateSql = "UPDATE users SET username = '$username', name = '$name' WHERE id=$id ";
    $result1 = mysqli_query($conn,$updateSql);
    if ($result1) header("Location: editUser.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UPDATE</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="" method="POST">
    <h2>Update Users</h2>  

        <label>Name</label>
        <input type="text" name="name" placeholder="Name" value="<?php echo $data['name'] ?>"><br>

        <label>User Name</label>
        <input type="text" name="username" placeholder="User Name" value=<?php echo $data['username'] ?>><br>

        <label>Admin</label>
        <input type="checkbox" name="authorize">
        
        <button type="submit" name="update">Update</button>
    </form>
</body>
</html>