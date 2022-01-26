<?php
include('./auth.php');

if (!$authenticated) {
    header("Location: ./login.php");
} else {
    if (!$admin) {
        header("Location: ./unauth.php");
    }
}

include("../utils/dbConnection.php");
$sql = "SELECT * FROM singers";
$result = mysqli_query($conn, $sql);
$singers = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Singer</title>
    <link rel="stylesheet" href="./css/editSinger.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <div class="container">
        <div class="link">
            <a class="ca2" href="adminDashboard.php">BACK</a>
        </div>

        <table id="customers" align="center" border="1" style="border-color: #fff;" class="displaySinger">
            <tr>
                <th colspan="6">SINGERS INFO</th>
            </tr>
            <tr>
                <th>No</th>
                <th>Images</th>
                <th>Name</th>
                <th>Info</th>
                <th colspan="3">Operations</th>
            </tr>


            <?php foreach ($singers as $index => $singer) : if ($index == 5) break; ?>
                <tr>
                    <td><?php echo $index + 1; ?></td>
                    <td><img style="width: 50px; height: 50px;" src="<?php echo '../' . $singer['image'] ?>"></td>
                    <td><?php echo $singer['name']; ?></td>
                    <td><?php echo $singer['info']; ?></td>
                    <td><a style="padding: 5px; background-color: #66FF33; color: #fff; border-radius: 15px; text-decoration: none;" href="insertSinger.php?id=<?php echo $singer['id'] ?>"><strong>Update</strong></a></td>
                    <td><a style="padding: 5px; background-color: #E3242B; color: #fff; border-radius: 15px; text-decoration: none;" href="deleteSinger.php?id=<?php echo $singer['id'] ?>"><strong>Delete</strong></a></td>
                </tr>
            <?php endforeach; ?>

        </table>
        <div class="c3"><a href=insertSinger.php>INSERT SINGER</a></div>
        <div class="paginationButton">
            <ul style="display: flex; list-style-type: none; color: black; margin: 0 auto; justify-content: center;">
                <li onclick="pagination(this.value);" style="padding: 10px;" value="1"> 1</li>
                <li onclick="pagination(this.value);" style="padding: 10px;" value="2"> 2</li>
                <li onclick="pagination(this.value);" style="padding: 10px;" value="3"> 3</li>
            </ul>
        </div>
    </div>

</body>
<script type="text/javascript">
    function pagination(value) {
        let header = `<tr>
            <th colspan="6">SINGERS INFO</th>
        </tr>
        <tr>
            <th>No</th>
            <th>Images</th>
            <th>Name</th>
            <th>Info</th>
            <th colspan="3">Operations</th>
        </tr>`
        let displaySinger = document.getElementsByClassName("displaySinger")[0];
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                let results = JSON.parse(this.responseText);;

                let html = '';
                displaySinger.innerHTML = header;

                results.map((value, index) => {
                    html +=
                        ` <tr>
                    <td> ${index + 1}</td>
                    <td><img style="width: 50px; height: 50px;" src='../${value['image']}'></td>
                    <td>${value['name']}</td>
                    <td>${value['info']}</td>
                    <td><a style="padding: 5px; background-color: #66FF33; color: #fff; border-radius: 15px; text-decoration: none;" href="insertSinger.php?id=${value['id']}">Update</a></td>
                    <td><a style="padding: 5px; background-color: #E3242B; color: #fff; border-radius: 15px; text-decoration: none;" href="deleteSinger.php?id=${value['id']}">Delete</a></td>
                    </tr>`
                })
                displaySinger.innerHTML += html;
            }
        };
        xhttp.open("GET", "paginationSinger.php?page=" + value, true);
        xhttp.send();
    }
</script>

</html>