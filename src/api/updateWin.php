<?php

    // If not logged-in, start session
    if(!isset($_SESSION)){
        session_start();
    }

    //Pulling the active(logged-in) player by his username
    $user=$_SESSION["username"];

    //Capturing Wins-Losses to get edited. 
    $wins=$_POST["wins"];
    $losses=$_POST["losses"];
    
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
    }