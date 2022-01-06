<?php
session_start();
include '../config/db.php';
$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
$input = json_decode(file_get_contents('php://input'),true);
if($input==null) {
    $input=[];
}


switch(array_shift($request)){
    case 'Board':
        $games = array();
        if($method == 'GET'){
            $res = selectBoard();
            while($row = $res->fetch_assoc()){
                array_push($games,$row);
            }
            echo json_encode($games);
        }
    case 'First':
        if($method == 'POST'){
            insertNew();
        }
    case 'Second':
        $games = array();
        if($method == 'POST'){
            insertSecond();
        }
}






function selectBoard(){
    include '../config/db.php';
    $sql = "SELECT * FROM board ORDER BY game_id DESC LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->get_result();
}

function insertNew(){
    include '../config/db.php';
    $uid = $_SESSION['uid'];
    $sql = "INSERT INTO board(p1_id) VALUES($uid)";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
}

function insertSecond(){
    include '../config/db.php';
    $uid = $_SESSION['uid'];
    $sql = "SELECT * FROM board ORDER BY game_id DESC LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $res = $stmt->get_result();
    while($row = $res->fetch_assoc()){
        $game_id = $row['game_id'];
    }
    $sql = "UPDATE board SET p2_id=$uid WHERE game_id=$game_id";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
}
