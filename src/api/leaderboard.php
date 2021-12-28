<?php

session_start();

    function showAvail(){
        include '../config/db.php';
        $sql = "SELECT username,wins,losses FROM users";
        $res = $conn->query($sql);
        return $res;
    }