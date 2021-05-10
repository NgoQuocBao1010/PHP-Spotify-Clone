<?php
session_start();
include("connection.php");


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

    $errors = array('name' => '', 'username' => '', 'password' => '', 're_password' => '');
    $user_data = 'uname=' . $username . '&name=' . $name;


    if (empty($username)) {
        $errors['username'] = "Cant be empty!!";
        header("Location: signup.php?error=User Name is required&$user_data");
        exit();
    } else if (empty($password)) {
        header("Location: signup.php?error=Password is required&$user_data");
        exit();
    } else if (empty($re_password)) {
        header("Location: signup.php?error=Re Password is required&$user_data");
        exit();
    } else if (empty($name)) {
        header("Location: signup.php?error=Name is required&$user_data");
        exit();
    } else if ($password !== $re_password) {
        header("Location: signup.php?error=The confirmation password does not match&$user_data");
        exit();
    } else {

        //hashing the password
        $password = md5($password);

        $sql = "SELECT * FROM users WHERE username = '$username' ";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            header("Location: signup.php?error=The username is taken try another&$user_data");
            exit();
        } else {
            $sql2 = "INSERT INTO users(username, password, name, groupID) VALUE('$username', '$password', '$name', 2)";
            $result2 = mysqli_query($conn, $sql2);
            if ($result2) {
                header("Location: login.php");
                exit();
            } else {
                header("Location: signup.php?error=unknown error occured&$user_data");
                exit();
            }
            // if (mysqli_query($conn, $sql2)) {
            // } else {
            //     echo "Error: " . mysqli_error($conn);
            // }
        }
    }
} else {
    header("Location: signup.php");
    exit();
}
