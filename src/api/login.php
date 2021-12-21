<?php

session_start();

    // if already loged in
    if(isset($_SESSION['loggedIn'])){
        header('location: ../../Queue/index.php');
        exit();
    }
    
    function readUser($user,$pass){
        include '../config/db.php';
        $sql = "SELECT id,username FROM users where username='$user' AND password='$pass'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $res = $stmt->get_result();
        return $res->fetch_assoc();
    }   

