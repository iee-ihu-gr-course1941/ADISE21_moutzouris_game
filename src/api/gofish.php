<?php
$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
$input = json_decode(file_get_contents('php://input'),true);
if($input==null) {
    $input=[];
}


switch($r=array_shift($request)){
    case 'login':
        login($input);
    case 'register':
        echo 'register';
        register($input);
    case 'leaderboard':
        $availableUsers = array();
        $users = leaderboard($method);
        while($row = $users->fetch_assoc()){
            array_push($availableUsers,$row);
        }
        echo json_encode($availableUsers);
}

function login($input){
    include 'login.php';
        $login = $input['login'];
        $username = $input['usernamePHP'];
        $passwd = strtolower(sha1($input['passwordPHP']));
        // echo json_encode($input);
        $user = readUser($username,$passwd);
        if(!is_null($user)){
            setUser($user);
            $_SESSION['uid'] = $user['id'];
            $_SESSION['loggedIn'] = $login;
            $_SESSION['username'] = $user['username'];
            exit('ok');
        }else{
            exit('not ok');
        }
}

function register($input){
    include 'register.php';
    $user = array(
        "username" => $input['usernamePHP'],
        "password" => strtolower(sha1($input['passwordPHP'])),
        "email"    => $input['emailPHP']
    );
    $newId = createUser($user);
    if(is_null($newId)){
        exit('Something went wrong try again');
    }else{
        $user['id'] = $newId;
        setUser($user);
        $_SESSION['loggedIn'] = 1;
        $_SESSION['uid'] = $newId;
        $_SESSION['username'] = $user['username'];
    }
}

function leaderboard($method){
    if($method == 'GET'){
        require 'leaderboard.php';
        $users = showAvail();
        return $users;
    }
}


function setUser($user){
    require '../config/db.php';
    $uid = $user['id'];
    $sql = "UPDATE users SET loggedIn='1' WHERE id=$uid";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
}