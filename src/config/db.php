<?php

$user = 'root';
$passwd = 'adse21';
$host='';
$db = 'adse21';
$conn = new mysqli($host, $user, $pass, $db, null, '/home/student/it/2018/it185289/mysql/run/mysql.sock');

if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
