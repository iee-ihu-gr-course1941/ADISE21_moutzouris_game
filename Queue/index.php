<?php
    session_start();

    if (!isset($_SESSION['loggedIn'])){
        header('location: ../');
        exit();
    }

    echo ' u are logged in! ' . $_SESSION['username'] . ',' . $_SESSION['uid'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="../src/js/join.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <br>
    <button id="joinGame" class="btn btn-info">Join a Game!</button>
    <br>
    <button class="btn btn-info"><a href="../src/api/logout.php">Logout</a></button>
    <br>
    <br>
    <div class="userDiv">
        <h4>Leaderboard</h4>
        <ul class="list-group" id="users">

        </ul>
        <table class="table table-striped">
        <thead>
            <tr>
            <th class="col">#</th>
            <th class="col">Losses</th>
            </tr>
        </thead>
        <tbody>
            
        </tbody>
        </table>
    </div>
    <style>
        a{
            text-decoration : none;
            color : black; 
        }
    </style>
</body>
</html>

