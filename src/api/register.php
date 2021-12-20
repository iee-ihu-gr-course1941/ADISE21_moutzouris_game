<?php
session_start();
echo 'waiting login';
if(isset($_POST['login'])){
    echo 'login set!';
    include '../config/db.php';
    $username= $_POST['usernamePHP'];
    $passwd = strtolower(sha1($_POST['passwordPHP']));
    // $passwd = $_POST['passwordPHP'];
    $email =  $_POST['emailPHP'];
    $stmt = $conn->prepare("INSERT INTO users(username,password,email) VALUES(?,?,?)");
    $stmt->bind_param("sss",$username,$passwd,$email);
    $stmt->execute();
    $_SESSION['loggedIn'] = 1;
    $_SESSION['username'] = $username;
    exit('Registration Succesfull!');
}



