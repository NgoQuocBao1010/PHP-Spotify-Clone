<?php
session_start();
$id = $username = $name = '';
if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
}
include("connection.php");
$sql = "SELECT * FROM users";
$result = mysqli_query($conn, $sql);
$users = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="link">
        <a class="ca2" href="adminDashboard.php">BACK</a>
        <a style="margin-top:5px;"></a>
    </div>
    <table align="center" border="2" style="width:600px; line-height:40px; color: white;">
        <tr>
            <th colspan="6">User Info</th>
        </tr>
        <tr>
            <th>STT</th>
            <th>Username</th>
            <th>Name</th>
            <th>Admin</th>
            <th colspan="2">Operations</th>
        </tr>


        <?php foreach ($users as $index => $user) : ?>
            <tr>
                <td><?php echo $index + 1; ?></td>
                <td><?php echo $user['username']; ?></td>
                <td><?php echo $user['name']; ?></td>
                <div class="checkbox-style"></div>
                <td><input type="checkbox" name="<?php echo $user['id'] ?>" id="<?php echo $user['id'] ?>" <?php if ($user['groupID'] == 1) : ?> checked <?php endif; ?> <?php if ($user['id'] == $id) : ?> fromUser <?php endif; ?>></td>
                <td><a style="padding: 5px; background-color: #E3242B; color: #fff; border-radius: 15px; text-decoration: none;" href="delete.php?id=<?php echo $user['id'] ?>"><strong>Delete</strong></a></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <script>
        const checkboxes = document.querySelectorAll("input[type=checkbox]");
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener("input", () => {
                if (checkbox.hasAttribute('fromuser')) {
                    alert("You can not set by you")
                    checkbox.checked = !checkbox.checked;
                } else {

                    const id = checkbox.id;
                    const admin = (checkbox.checked) ? 1 : 2;
                    // console.log("check", id, checkbox.checked);

                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            if (this.responseText !== "") {
                                console.log(this.responseText);
                            }
                        }
                    };
                    xmlhttp.open("GET", `admin.php?uid=${id}&admin=${admin}`, true);
                    xmlhttp.send();
                }


            })
        })
    </script>
</body>

</html>