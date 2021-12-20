<?php
    session_start();

    if (!isset($_SESSION['loggedIn'])){
        header('location: ../login.php');
        exit();
    }

    echo ' u are logged in! ' . $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <br>
    <a href="../Board/index.html">Join A Game</a>
    <br>
    <a href="../src/api/logout.php">Logout</a>
    <br>
    <a href="#">Check Leaderboard</a>
</body>
</html>

