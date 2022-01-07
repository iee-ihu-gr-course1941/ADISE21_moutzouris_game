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
    case 'Game':
        $game=array();
        $res = getPturn();
        while($row = $res->fetch_assoc()){
            array_push($game,$row);
        }
        echo json_encode($game);
    case 'Update':
        $new_p1_hand = $input['new_p1_hand'];
        $new_p2_hand = $input['new_p2_hand'];
        $p_turn = $input['new_p_turn'];
        if($new_p2_hand == ''){
            finishGame('p2',$new_p1_hand,$new_p2_hand);
        }else if($new_p1_hand == ''){
            finishGame('p1',$new_p1_hand,$new_p2_hand);
        }else{
            updateGame($new_p1_hand,$new_p2_hand,$p_turn);
        }
}



function getPturn(){
    require '../config/db.php';
    $sql = "SELECT * FROM board ORDER BY game_id DESC LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $res = $stmt->get_result();
    return $res;
}

function finishGame($winner,$new_p1_hand,$new_p2_hand){
    require '../config/db.php';
    $sql = "SELECT * FROM board ORDER BY game_id DESC LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $res = $stmt->get_result();
    while($row = $res->fetch_assoc()){
        $game_id = $row['game_id'];
        $p1_id = $row['p1_id'];
        $p2_id = $row['p2_id'];
    }
    if($winner == 'p1'){
        $sql = "UPDATE board SET p1_hand = '$new_p1_hand' , p2_hand = '$new_p2_hand' , p_turn = null , result = $p1_id  WHERE game_id = $game_id";
    }else{
        $sql = "UPDATE board SET p1_hand = '$new_p1_hand' , p2_hand = '$new_p2_hand' , p_turn = null , result = $p2_id  WHERE game_id = $game_id";
    }
    $stmt = $conn->prepare($sql);
    $stmt->execute();
}

function updateGame($new_p1_hand,$new_p2_hand,$p_turn){
    require '../config/db.php';
    $sql = "SELECT * FROM board ORDER BY game_id DESC LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $res = $stmt->get_result();
    while($row = $res->fetch_assoc()){
        $game_id = $row['game_id'];
    }
    $sql = "UPDATE board SET p1_hand = '$new_p1_hand' , p2_hand = '$new_p2_hand' , p_turn = '$p_turn' WHERE game_id = $game_id";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

}