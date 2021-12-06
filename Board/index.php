<!-- This is the testing html-->
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
    <a href="../src/api/logout.php">Logout</a>
</body>
</html>






<!-- This is the real html-->

<!-- <!doctype html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="../board.css">
</head>

<body>
    <div class="welcome">
        <h2>Welcome 
        </h2>
        <br/>
        <h2><a href="../src/api/logout.php">Logout</a></h2>
    </div>
    <div class="cards">
        <div class="card">
            <div class="card-face">
                <div class="card-label">1</div>
            </div>
        </div>
        <div class="card">
            <div class="card-face">
                <div class="card-label">2</div>
            </div>
        </div>
        <div class="card">
            <div class="card-face">
                <div class="card-label">3</div>
            </div>
        </div>
        <div class="card">
            <div class="card-face">
                <div class="card-label">4</div>
            </div>
        </div>
        <div class="card">
            <div class="card-face">
                <div class="card-label">5</div>
            </div>
        </div>
        <div class="card">
            <div class="card-face">
                <div class="card-label">6</div>
            </div>
        </div>
        <div class="card">
            <div class="card-face">
                <div class="card-label">7</div>
            </div>
        </div>
        <div class="card">
            <div class="card-face">
                <div class="card-label">8</div>
            </div>
        </div>
        <div class="card">
            <div class="card-face">
                <div class="card-label">9</div>
            </div>
        </div>
        <div class="card">
            <div class="card-face">
                <div class="card-label">10</div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>

    </script>
</body>

</html> -->