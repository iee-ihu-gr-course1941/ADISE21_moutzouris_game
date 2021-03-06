<?php
    session_start();

    if (!isset($_SESSION['loggedIn'])){
        header('location: ../');
        exit();
    }

    // echo ' u are logged in! ' . $_SESSION['username'] . ',' . $_SESSION['uid'];
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"      
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" 
      crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" 
      crossorigin="anonymous">
    <title>Players - Leaderboard</title>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Moutzouris Game</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a id="joinGame" class="btn btn-info" role="button">Join a Game!</a>
          </li>
          <li class="nav-item" style="margin-left: 10px;">
            <a class="btn btn-danger" role="button" href="../src/api/logout.php">Logout</a>
          </li>
        </ul>
        <span class="navbar-text">
        <?php
          echo 'Hello ' . $_SESSION['username'] . '!';
          echo "<div id='playerId' style='visibility:hidden;display:inline' myId=" . $_SESSION['uid'] . " >".$_SESSION['username']."</div>";
        ?>
        </span>
      </div>
    </div>
  </nav>

  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12 userDiv">
            <h4>Leaderboard</h4>
            <ul class="list-group" id="users">
            </ul>
            <table class="table table-striped">
            <thead>
                <tr>
                <th class="col">#</th>
                <th class="col">Losses</th>
                <th class="col-1">Connected</th>
                </tr>
            </thead>
            <tbody id="tableBody">
                      
            </tbody>
            </table>
      </div>
    </div>
  </div>
    <style>
        a{
            text-decoration : none;
            color : black; 
        }
    </style>
</body>
</html>
