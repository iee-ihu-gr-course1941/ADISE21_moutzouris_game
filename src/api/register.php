<?php
session_start();

function createUser($user){
    include '../config/db.php';
    $username= $user['username'];
    $passwd = $user['password'];
    $email =  $user['email'];
    $sql = "INSERT INTO users(username,password,email) VALUES(?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss",$username,$passwd,$email);
    $stmt->execute();
    return $conn->insert_id;
}
