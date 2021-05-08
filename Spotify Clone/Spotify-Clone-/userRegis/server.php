<?php 
    include('dbConnection.php');
    session_start();

    // User's variables
    $username = '';
    $email = '';
    $errors = array();

    if (isset($_POST['reg_user'])) {
        // Get input from forms
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password_1 = mysqli_real_escape_string($conn, $_POST['password_1']);
        $password_2 = mysqli_real_escape_string($conn, $_POST['password_2']);

        // Validation forms
        if (empty($username)) { array_push($errors, "Username is required"); }
        if (empty($email)) { array_push($errors, "Email is required"); }
        if (empty($password_1)) { array_push($errors, "Password is required"); }
        if ($password_1 != $password_2) {
            array_push($errors, "The two passwords do not match");
        }

        // Check if user or email exist
        $getUserQuery = "SELECT * FROM Users 
                        WHERE username='$username' OR email='$email'";
        $result = mysqli_query($conn, $getUserQuery);
        $user = mysqli_fetch_assoc($result);

        if ($user) {
            if ($user['username'] === $username) {
                array_push($errors, "Username is already exist!!");
            }
            if ($user['email'] === $email) {
                array_push($errors, "Email is already exist!!");
            }
        }


        if (count($errors) == 0) {
            $password = md5($password_1);
            $query = "INSERT INTO Users (username, email, password, groupID) 
  			          VALUES('$username', '$email', '$password', 2)";
            
            if (mysqli_query($conn, $query)) {
                $_SESSION['username'] = $username;
  	            $_SESSION['login'] = true;
  	            $_SESSION['role'] = 'user';
                header('Location: index.php');
            } 
            else {
                echo "Error: " . $query . "<br>" . mysqli_error($conn);
            }
        }
        else {
            foreach ($errors as $error) {
                echo "$error" . "<br>";
            }
        }
    }

    if (isset($_POST['login_user'])) {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
      
        if (empty($username)) {
            array_push($errors, "Username is required");
        }
        if (empty($password)) {
            array_push($errors, "Password is required");
        }

        if (count($errors) == 0) {
            $password = md5($password);
            $query = "SELECT * FROM users 
                    WHERE username='$username' AND password='$password'";
            $result = mysqli_query($conn, $query);
            $user = mysqli_fetch_assoc($result);

            if (mysqli_num_rows($result) == 1) {
                $_SESSION['username'] = $username;
  	            $_SESSION['login'] = true;
  	            $_SESSION['role'] = ($user['groupID'] === '1') ? 'admin' : 'user';
                header('Location: index.php');
            } 
            else {
                echo "Error: " . $query . "<br>" . mysqli_error($conn);
            }
        }
    
        else {
            foreach ($errors as $error) {
                echo "$error" . "<br>";
            }
        }
    }
?>