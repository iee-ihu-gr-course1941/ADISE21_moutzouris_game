<?php
    session_start();

    require '../config/db.php';
    $uid = $_SESSION['uid'];
    $sql = "UPDATE users SET loggedIn='0' WHERE id=$uid";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    unset($_SESSION['uid']);
    unset($_SESSION['username']);
    unset($_SESSION['loggedIn']);
    session_destroy();
    header('location: ../../');
    exit();