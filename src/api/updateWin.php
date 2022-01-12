<?php

    // If not logged-in, start session
    if(!isset($_SESSION)){
        session_start();
    }

    function UpdateWin(){

        //Pulling the active(logged-in) player by his username
        $user=$_SESSION['uid'];

        /*Capturing Wins-Losses to get edited. 
        $wins=$_POST["wins"];
        $losses=$_POST["losses"];
        */

        include '../config/db.php';

        $query_WIN = "UPDATE users
                      SET wins = wins+1
                      WHERE id = ?";
        $stmt=$conn->prepare($query_WIN);
        $stmt->bind_param("i", $user);
        $stmt->execute();
    }

    function UpdateLoss(){

        //Pulling the active(logged-in) player by his username
        $user=$_SESSION['uid'];

        /*Capturing Wins-Losses to get edited. 
        $wins=$_POST["wins"];
        $losses=$_POST["losses"];
        */

        include '../config/db.php';

        $query_LOSS = "UPDATE users
                       SET losses = losses+1
                       WHERE id = ?";
        $stmt=$conn->prepare($query_LOSS);
        $stmt->bind_param("i", $user);
        $stmt->execute();
    }

    UpdateWin();

    /*
    function UpdateWinLosses(){
        include '../config/db.php';
        
        $query_WIN = mysqli_query($conn,"UPDATE users
                                    SET wins = $wins + 1
                                    WHERE users='$user';");

        
        $query_LOSS = mysqli_query($conn,"UPDATE users
                                        SET losses = $losses + 1
                                        WHERE users='$user';");
        
        //Running Query
        mysqli_query($conn, $query_WIN);
        mysqli_query($conn, $query_LOSS);
    }*/