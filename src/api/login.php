<?php

session_start();

    // if already loged in
    if(isset($_SESSION['loggedIn'])){
        header('location: ../../Queue/index.php');
        exit();
    }
    if(isset($_POST['login'])){
        include '../config/db.php';
        $username = $conn->real_escape_string($_POST['usernamePHP']);
        $passwd = strtolower(sha1($conn->real_escape_string($_POST['passwordPHP'])));

        $data = $conn->query("SELECT id from users WHERE username='$username' AND password= '$passwd'");
        if($data->num_rows > 0){
            /// everything ok 
            while($row = $data->fetch_assoc()){
                $id = $row['id'];
            }
            $_SESSION['loggedIn'] = 1;
            $_SESSION['username'] = $username;
            $_SESSION['uid'] = $id;
            // header('location: ../../Queue/index.php');
            exit('Login successful');
        }else{
            exit('username or password were not found!');
        }

    }