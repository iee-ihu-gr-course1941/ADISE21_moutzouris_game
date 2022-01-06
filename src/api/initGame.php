<?php
session_start();
$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
$input = json_decode(file_get_contents('php://input'),true);
if($input==null) {
    $input=[];
}
switch(array_shift($request)){
    case 'onlineUsers':
        $_SESSION['joinGame'] = true;
        $opps = fetchOnlineUsers();
        echo json_encode($opps);
    case 'initialize':
        if($method == 'POST'){
            init_game_status();
        }

}

function fetchOnlineUsers(){
    require '../config/db.php';
    $sql = "SELECT username FROM users WHERE loggedIn='1'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $res = $stmt->get_result();
    $opps = array();
    while($row = $res->fetch_assoc()){
        if($row['username'] != $_SESSION['username']){
            array_push($opps,$row['username']);
        }
    }
    return $opps;
}

function init_game_status(){
    include 'updateGame.php';
    initGameStatus();    
}