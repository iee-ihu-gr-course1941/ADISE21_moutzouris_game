<?php

session_start();

    function showAvail(){
        include '../config/db.php';
        $sql = "SELECT username FROM users where loggedIn='1'";
        $res = $conn->query($sql);
        return $res;
    }