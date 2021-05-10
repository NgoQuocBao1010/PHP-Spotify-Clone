<?php
session_start();
include ("connection.php");


if(isset($_POST['username']) && isset($_POST['password']) 
	&& isset($_POST['name']) && isset($_POST['re_password'])){

    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    
    $username = validate($_POST['username']);
    $password = validate($_POST['password']);

    $re_password = validate($_POST['re_password']);
    $name = validate($_POST['name']);

	$user_data = 'uname='. $username.'&name='. $name;


    if (empty($username)) {
        header("Location: signup.php?error=User Name is required&$user_data");
        exit();
    }else if(empty($password)){
        header("Location: signup.php?error=Password is required&$user_data");
        exit();
    }
	else if(empty($re_password)){
        header("Location: signup.php?error=Re Password is required&$user_data");
        exit();
    }
	else if(empty($name)){
        header("Location: signup.php?error=Name is required&$user_data");
        exit();
    }

	else if($password !== $re_password){
        header("Location: signup.php?error=The confirmation password does not match&$user_data");
        exit();
    }
	
	else{

		//hashing the password
		$password = md5($password);

        $sql = "SELECT * FROM users WHERE username = '$username' ";
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) > 0){
			header("Location: signup.php?error=The username is taken try another&$user_data");
        	exit();
		}else{
			$sql2 = "INSERT INTO users(username, password, name, group) VALUE('$username', '$password', '$name', 2)";
			$result2 = mysqli_query($conn, $sql2);
			if($result2){
				header("Location: signup.php?success=Your account has been created successfully");
        	exit();
			}else{
				header("Location: signup.php?error=unknown error occured&$user_data");
        		exit();
			}
		}
    }


}else{
    header("Location: signup.php");
    exit();
}