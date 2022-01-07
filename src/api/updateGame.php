<?php

function initGameStatus(){
    require_once '../config/db.php';
    $sql = "INSERT INTO game_status(status) VALUES('initialized')";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
}