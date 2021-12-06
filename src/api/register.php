<?php
session_start();
if(isset($_POST['login'])){
    include '../config/db.php';
    $username= $_POST['usernamePHP'];
    $passwd = strtolower(sha1($_POST['passwordPHP']));
    $email =  $_POST['emailPHP'];
    $stmt = $conn->prepare("INSERT INTO users(username,password,email) VALUES(?,?,?)");
    $stmt->bind_param("sss",$username,$passwd,$email);
    $stmt->execute();
    $_SESSION['loggedIn'] = 1;
    $_SESSION['username'] = $username;
    exit('Registration Succesfull!');
}



