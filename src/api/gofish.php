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
}

function login($input){
    include 'login.php';
        $login = $input['login'];
        $username = $input['usernamePHP'];
        $passwd = strtolower(sha1($input['passwordPHP']));
        // echo json_encode($input);
        $user = readUser($username,$passwd);
        if(!is_null($user)){
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
        $_SESSION['loggedIn'] = 1;
        $_SESSION['uid'] = $newId;
        $_SESSION['username'] = $user['username'];
    }
}